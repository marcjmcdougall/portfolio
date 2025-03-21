<?php

namespace App\Jobs\QuickScan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use HeadlessChromium\BrowserFactory;


use App\Models\QuickScan as QuickScanModel;
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
        $html = Http::get($this->quickScan->url)->body();

        $markupSizeBytes = strlen($html);
        $markupSizeKB = round($markupSizeBytes / 1024, 2);

        $this->quickScan->update([
            'html_content' => $html,
            'title' => $this->extractMainDomain($this->quickScan->url),
        ]);

        $this->quickScan->setInfo('html_size_kb', $markupSizeKB);

        $this->captureScreenshot();

        $this->quickScan->addProgress(10);  // 10%
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
                'screenshot_path' => $relativePath
            ]);
        } finally {
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
