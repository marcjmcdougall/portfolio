<?php

namespace App\Jobs\QuickScan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Models\QuickScan as QuickScanModel;
use Illuminate\Support\Facades\Log;

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
        // Get the value of the first <h1> element
        
        preg_match('/<h1[^>]*>(.*?)<\/h1>/is', $this->quickScan->html_content, $matches);
        $title = $matches[0] ?? null;

        // Todo: Logging won't work
        // Log::info('Title: ' . $title);

        // Todo: `title` won't update.
        $this->quickScan->update([
            'title' => $title,
            'progress' => 50
        ]);

        $currentIssues = $this->quickScan->issues ?? [];

        // Add a new issue to the array
        $newIssue = [
            'type' => 'missing_alt_tag',
            'severity' => 'medium',
            'description' => 'Image is missing an alt tag',
            'location' => 'line 42'
        ];

        $currentIssues[] = $newIssue;

        // Update the model with the new issues array
        $this->quickScan->update([
            'issues' => $currentIssues
        ]);
    }
}
