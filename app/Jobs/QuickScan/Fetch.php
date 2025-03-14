<?php

namespace App\Jobs\QuickScan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Models\QuickScan as QuickScanModel;
use Illuminate\Support\Facades\Http;

class Fetch implements ShouldQueue
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
        $html = Http::get($this->quickScan->url)->body();

        $this->quickScan->update([
            'html_content' => $html,
            'progress' => 30
        ]);
    }
}
