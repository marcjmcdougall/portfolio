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
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Fetch HTML content
            $response = Http::get($this->quickScan->url . 'test');
            $html = $response->body();
            
            // Calculate HTML size
            $markupSizeBytes = strlen($html);
            $markupSizeKB = round($markupSizeBytes / 1024, 2);
            
            // Save changes so far
            $this->quickScan->update([
                'html_content' => ApiResult::success($html),
                'html_size' => ApiResult::success($markupSizeKB),
            ]);
            
            // Capture screenshot
            try {
                $this->captureScreenshot();
            } catch (\Exception $e) {
                // Screenshot failed, but we can continue
                // You might want to store this as a partial result if screenshots are important
                \Log::warning("Screenshot failed for {$this->quickScan->url}: {$e->getMessage()}");
            }
            
            // Update progress
            $this->quickScan->addProgress(10);  // 10%
        } catch (\Exception $e) {
            // Handle the case where the initial HTTP request fails
            $this->quickScan->update([
                'html_content' => ApiResult::error("Failed to fetch URL: {$e->getMessage()}"),
                'html_size' => ApiResult::error("Could not calculate size: HTTP request failed"),
                'screenshot_path' => ApiResult::error("Could not take screenshot: HTTP request failed"),
                'openai_messaging_audit' => ApiResult::error("Could not parse HTML: HTTP request failed"),
                'performance_metrics' => ApiResult::error("Could not evaluate performance: HTTP request failed"),
                'status' => 'failed', // Set this to fail to prevent further jobs from running.
            ]);
            
            Log::error("Failed to process {$this->quickScan->url}: {$e->getMessage()}");
        }
    }

    public function captureScreenshot()
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
        ]);
        
        try {
            // Create a new page and navigate to the URL
            $page = $browser->createPage();
            $navigation = $page->navigate($url);
            
            // Wait for the page to be loaded
            $navigation->waitForNavigation();
            
            // Wait additional time for any dynamic content to load
            usleep(2000000); // 2 seconds
            
            // Take a screenshot
            $screenshot = $page->screenshot([
                'format' => 'png',
                'fullPage' => true
            ]);
            
            // Save the screenshot
            $screenshot->saveToFile($screenshotPath);

            // Update the QuickScan model
            $this->quickScan->update([
                'screenshot_path' => ApiResult::success($relativePath),
            ]);
        } catch (\Exception $e) {
            $this->quickScan->update([
                'screenshot_path' => ApiResult::error("Could not take screenshot: {$e->getMessage()}"),
            ]);
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
