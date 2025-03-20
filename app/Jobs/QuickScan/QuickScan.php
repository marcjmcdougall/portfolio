<?php

namespace App\Jobs\QuickScan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\Bus;
use Throwable;


use App\Models\QuickScan as QuickScanModel;
use App\Jobs\QuickScan\Subscribe;
use App\Jobs\QuickScan\Fetch;
use App\Jobs\QuickScan\Evaluate;
use App\Jobs\QuickScan\Inform;

class QuickScan implements ShouldQueue
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
        $this->quickScan->update([
            'status' => 'processing',
        ]);

        // Perform all the actions necessary to scan a website.
        Bus::chain([
            new Subscribe($this->quickScan),      // Add visitor to email list
            new Fetch($this->quickScan),      // Fetch website
            new Evaluate($this->quickScan),   // Evaluate website
            new Inform($this->quickScan),     // Email the visitor
        ])->catch(function (Throwable $e) {
            // A job within the chain has failed
            // $this->quickScan->update([
            //     'status' => 'failed',
            // ]);
        })->dispatch();
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array<int, object>
     */
    public function middleware(): array
    {
        // Prevents duplicate URLs from being processed simultaneously
        return [(new WithoutOverlapping($this->quickScan->url))->dontRelease()];
    }
}
