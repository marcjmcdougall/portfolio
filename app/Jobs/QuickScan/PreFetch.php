<?php

namespace App\Jobs\QuickScan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use HeadlessChromium\BrowserFactory;


use App\Models\QuickScan as QuickScanModel;
class PreFetch implements ShouldQueue
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
        // Add user to Kit.com email list
        // Ref: https://developers.kit.com/v4#create-a-subscriber
        $response = Http::withHeaders([
            'Authorization' => 'Bearer: ' . config('services.kit.api_key'),
            'Content-Type' => 'application/json'
        ])->post("https://api.kit.com/v4/subscribers", [
            'email_address' => $this->quickScan->email,
            'source' => 'website',
        ]);

        Log::info('Response from Kit (signup): ' . $response);

        // Tag user with "CRO QuickScan"
        // Ref: https://developers.kit.com/v4#tag-a-subscriber-by-email-address
        $response = Http::withHeaders([
            'Authorization' => 'Bearer: ' . config('services.kit.api_key'),
            'Content-Type' => 'application/json'
        ])->post("https://api.kit.com/v4/tags/7097136/subscribers", [
            'email_address' => $this->quickScan->email,
            'source' => 'website',
        ]);

        Log::info('Response from Kit (tag): ' . $response);
    }
}
