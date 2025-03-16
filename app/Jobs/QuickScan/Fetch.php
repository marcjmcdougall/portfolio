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

        $this->quickScan->update([
            'html_content' => $html,
            'progress' => 20
        ]);

        $this->captureScreenshot();
    }

    public function captureScreenshot()
    {
        $url = $this->quickScan->url;
        $screenshotPath = storage_path('app/public/quick-scans/screenshots/' . $this->quickScan->id . '.png');
        
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
            
            // Todo: Screenshot path needs to be a string!
            // Update the QuickScan model
            $this->quickScan->update([
                'screenshot_path' => $screenshotPath
            ]);
        } finally {
            // Close the browser
            $browser->close();
        }
    }
}
