<?php

namespace App\Jobs\QuickScan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use HeadlessChromium\BrowserFactory;
use App\Mail\QuickScanCompleted;
use App\Mail\QuickScanInform;


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

        // Record analytics event
        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . config('services.fathom.api_key'),
        // ])->post('https://api.usefathom.com/v1/sites/' . config('services.fathom.site_id') . '/events', [
        //     'name' => config('services.fathom.event_name'),
        // ]);

        // Log::info('Response from Fathom: ' . $response);

        // Notify the user that their QuickScan has been completed.
        Mail::to($this->quickScan->email)->send(new QuickScanCompleted($this->quickScan));

        // If the user is not the admin, inform the admin as well.
        if ( config('app.admin.email') !== $this->quickScan->email ) {
            Mail::to(config('app.admin.email'))->send(new QuickScanInform($this->quickScan));
        }
    }
}
