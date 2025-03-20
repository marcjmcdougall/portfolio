<?php

namespace App\Jobs\QuickScan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use HeadlessChromium\BrowserFactory;
use App\Mail\QuickScanCompleted;


use App\Models\QuickScan as QuickScanModel;
class Inform implements ShouldQueue
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
        Log::info('Emailing ' . $this->quickScan->email . ' now...');
        // Notify the user that their CRO QuickScan has been completed.
        Mail::to($this->quickScan->email)->send(new QuickScanCompleted($this->quickScan));
    }
}
