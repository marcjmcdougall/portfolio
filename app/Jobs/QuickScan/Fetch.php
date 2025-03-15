<?php

namespace App\Jobs\QuickScan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


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
    }
}
