<?php

namespace App\Jobs\QuickScan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use HeadlessChromium\BrowserFactory;

use App\Models\QuickScan as QuickScanModel;
use App\Helpers\ApiResult;

class Fetch implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public QuickScanModel $quickScan
    )
    {
        $this->onQueue('fetch');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Get browser instance and fetch rendered HTML
            $browserResult = $this->getRenderedHtmlAndScreenshot();
            
            // Calculate HTML size
            $html = $browserResult['html'];
            $markupSizeBytes = strlen($html);
            $markupSizeKB = round($markupSizeBytes / 1024, 2);
            
            // Save changes
            $this->quickScan->update([
                'html_content' => ApiResult::success($html),
                'html_size' => ApiResult::success($markupSizeKB),
                'screenshot_path' => ApiResult::success($browserResult['screenshot_path']),
            ]);
        } catch (\Exception $e) {
            // Handle the case where the initial HTTP request fails
            $this->quickScan->fail('Error fetching or parsing HTML', $e);
            Log::error("Failed to process {$this->quickScan->url}: {$e->getMessage()}");
        }

        // Update progress no matter what
        $this->quickScan->addProgress(10);  // 10%
    }

    public function getRenderedHtmlAndScreenshot()
    {
        $url = $this->quickScan->url;
        $relativePath = 'quick-scans/screenshots/' . $this->quickScan->id . '.png';
        $screenshotPath =  storage_path('app/public/' . $relativePath); 
        
        // Make sure the directory exists
        if (!file_exists(dirname($screenshotPath))) {
            mkdir(dirname($screenshotPath), 0755, true);
        }
        
        // Create a browser instance
        $browserFactory = new BrowserFactory();
        $browser = $browserFactory->createBrowser([
            'headless' => true,
            'windowSize' => [1280, 800],
            'noSandbox' => true,
            'sendSyncDefaultTimeout' => 30000, // 30 seconds in milliseconds
            'args' => [
            '--disable-dev-shm-usage',
            '--disable-extensions',
            '--disable-accelerated-2d-canvas',
            '--disable-translate',
            '--memory-pressure-off',
            '--single-process', // Force single process
    ]
        ]);
        
        try {
            // Create a new page and navigate to the URL
            $page = $browser->createPage();
            $navigation = $page->navigate($url);
            
            // Wait for the page to be loaded
            $navigation->waitForNavigation();
            
            // Wait additional time for any dynamic content to load
            usleep(2000000); // 2 seconds

            // Check for Cloudflare challenge
            $cloudflareDetected = $page->evaluate('
                document.body.textContent.includes("Verifying you are human") ||
                document.body.textContent.includes("needs to review the security of your connection") ||
                document.body.textContent.includes("Checking your browser") ||
                document.querySelector("#challenge-running") !== null ||
                document.querySelector("div.cf-browser-verification") !== null || 
                document.querySelector("div.cf-challenge-running") !== null ||
                document.querySelector("#challenge-form") !== null ||
                document.querySelector("#cf-please-wait") !== null
            ')->getReturnValue();
            
            // If found, gracefully exit
            if ($cloudflareDetected) {
                throw new \Exception("Cloudflare protection detected - cannot access the page content");
            }

            // Get the full HTML
            $html = $page->evaluate('document.documentElement.outerHTML')->getReturnValue();
            
            // Take a screenshot
            $screenshot = $page->screenshot([
                'format' => 'png',
                'fullPage' => true
            ]);
            
            // Save the screenshot
            $screenshot->saveToFile($screenshotPath);

            return [
                'html' => $html,
                'screenshot_path' => $relativePath
            ];
        } catch (\Exception $e) {
            throw $e;
        } 
        finally {
            // Close the browser
            $browser->close();
        }
    }

    function extractMainDomain($url) {
        // Parse the URL to get its components
        $parsedUrl = parse_url($url);
        
        // Get the host component (e.g., "terminus.com")
        $host = isset($parsedUrl['host']) ? $parsedUrl['host'] : '';
        
        // If no host was found, the URL might be malformed or relative
        if (empty($host)) {
            return null;
        }
        
        // Split the host by dots
        $parts = explode('.', $host);
        
        // For most URLs, the main domain name is the second-to-last part
        // For example, in "www.terminus.com", it would be "terminus"
        // In "terminus.com", it would be "terminus"
        
        if (count($parts) >= 2) {
            // Check if the host might start with "www"
            $domainIndex = (strtolower($parts[0]) === 'www') ? 1 : 0;
            
            // Return the main domain part
            return $parts[$domainIndex];
        }
        
        return null;
    }
}
