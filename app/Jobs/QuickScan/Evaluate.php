<?php

namespace App\Jobs\QuickScan;

use App\Helpers\OpenAIController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Bus;
use Illuminate\Bus\Batch;
use Throwable;

use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Support\Facades\Http;

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
        Bus::batch([
            new EvaluateCopy($this->quickScan),
            new EvaluateImages($this->quickScan),
            new EvaluateLoadTime($this->quickScan),
        ])->then(function (Batch $batch) {
            // All jobs completed successfully.

            // Update the model with the new issues array
            // $this->quickScan->update([
            //     'status' => 'completed',
            //     'progress' => 100
            // ]);

            Log::info('✅ All eval jobs completed.');
        })->dispatch();

    }
}
