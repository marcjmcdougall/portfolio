<?php

namespace App\Jobs\QuickScan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

use Symfony\Component\DomCrawler\Crawler;

use App\Models\QuickScan as QuickScanModel;

class Evaluate implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public QuickScanModel $quickScan
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $crawler = new Crawler($this->quickScan->html_content);

        // Get the first h1 content
        $title = $crawler->filter('h1')->first()->text();

        $this->quickScan->update([
            'title' => $title,
            'progress' => 50
        ]);

        $currentIssues = $this->quickScan->issues ?? [];
        $issues = [];

        // Find images without alt tags
        $crawler->filter('img')->each(function (Crawler $image) use (&$issues) {
            $alt = $image->attr('alt');
            
            if ($alt === null || $alt === '') {
                $issues[] = [
                    'type' => 'missing_alt_tag',
                    'severity' => 'medium',
                    'description' => 'Image missing alt text: ' . $image->attr('src'),
                    'location' => $image->outerHtml()
                ];
            }
        });

        $currentIssues[] = $issues;

        // Update the model with the new issues array
        $this->quickScan->update([
            'issues' => $currentIssues
        ]);
    }
}
