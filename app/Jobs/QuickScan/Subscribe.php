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
        $response = Http::timeout(30)  // Set a reasonable timeout
            ->retry(3, function ($attempt) {
                // Calculate delay with exponential backoff (1s, 2s, 4s)
                $baseDelay = 1000 * (2 ** ($attempt - 1));
                
                // Add jitter (±20%)
                $jitterFactor = mt_rand(80, 120) / 100;
                $delay = $baseDelay * $jitterFactor;
                
                // Log retry attempt
                Log::warning("ConvertKit API retry attempt {$attempt} for email: {$this->quickScan->email}. Waiting {$delay}ms before next attempt.");
                
                return $delay;
            }, function ($exception, $request) {
                // Log exception
                Log::error("ConvertKit API request failed: " . $exception->getMessage());
                
                // Retry for all exceptions
                return true;
            })
            ->withHeaders([
                'Content-Type' => 'application/json; charset=utf-8'
            ])
            ->post('https://api.convertkit.com/v3/forms/' . config('services.kit.form_id') . '/subscribe', [
                'api_key' => config('services.kit.api_key'),
                'email' => $this->quickScan->email,
                'tags' => [7097136] // Tag: 'CRO QuickScan'
            ]);

        // Handle the response
        if ($response->successful()) {
            Log::info("User {$this->quickScan->email} successfully added to ConvertKit");
        } else {
            // Log the error details
            Log::error("ConvertKit API error after retries: Status {$response->status()} - " . $response->body());
        }

        Log::info('Response from Kit (subscribe + tag): ' . $response);
    }
}
