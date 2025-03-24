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

class EvaluateThenInform implements ShouldQueue
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
        // Create a local variable to use in the closure instead of $this
        $quickScan = $this->quickScan;

        Bus::batch([
            new EvaluateLoadTime($this->quickScan),
            new EvaluateCopy($this->quickScan),
            new EvaluateImages($this->quickScan),
        ])->then(function (Batch $batch) use ($quickScan) {
            // Now that everything is truly done, inform the user
            dispatch(new Inform($quickScan)); // Email the visitor

            Log::info('✅ All eval jobs completed.');
        })->finally(function (Batch $batch) use ($quickScan) {
            // Log::info('⚠️ Batch processing completed (success or failure)');
        })->dispatch();
    }
}
