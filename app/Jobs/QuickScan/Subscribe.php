<?php

namespace App\Jobs\QuickScan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use HeadlessChromium\BrowserFactory;


use App\Models\QuickScan as QuickScanModel;
class Subscribe implements ShouldQueue
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
        // Add user to Kit, and tag them appropriately
        // Ref: https://developers.kit.com/v3?shell#add-subscriber-to-a-form
        $response = Http::withHeaders([
            'Content-Type' => 'application/json; charset=utf-8'
        ])->post('https://api.convertkit.com/v3/forms/' . config('services.kit.form_id') . '/subscribe', [
            'api_key' => config('services.kit.api_key'),
            'email' => $this->quickScan->email,
            'tags' => [7097136] // Tag: 'CRO QuickScan'
        ]);

        Log::info('Response from Kit (subscribe + tag): ' . $response);
    }
}
