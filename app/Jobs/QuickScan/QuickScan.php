<?php

namespace App\Jobs\QuickScan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\Http;

use App\Models\QuickScan as QuickScanModel;
use App\Jobs\QuickScan\Fetch;
use App\Jobs\QuickScan\Evaluate;

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
            'progress' => 10
        ]);

        $html = Http::get($this->quickScan->url)->body();

        $this->quickScan->update([
            'html_content' => $html,
            'progress' => 30
        ]);

        // Perform all the actions necessary to scan a website.
        // Bus::chain([
        //     new Fetch($this->url, $this->command),  // Fetch website
        //     // new Evaluate,   // Evaluate website
        // ])->catch(function (Throwable $e) {
        //     // A job within the chain has failed...
        // })->dispatch();

        // For now, just sychronously perform the job.
        // Fetch::dispatchSync($this->url);
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
