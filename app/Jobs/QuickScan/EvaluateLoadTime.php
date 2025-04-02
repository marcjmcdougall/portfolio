<?php

namespace App\Jobs\QuickScan;

use App\Helpers\ApiResult;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

use App\Models\QuickScan;

class EvaluateLoadTime implements ShouldQueue
{
    use Queueable;
    use Queueable, Batchable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public QuickScan $quickScan
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $url = $this->quickScan->url;
        $apiKey = config('services.google.pagespeed_api_key');

        Log::info('Evaluating page speed now... ');
        
        try {
            $response = Http::timeout(120)
                ->retry(3, function ($attempt) {
                    // Calculate base delay with exponential backoff (2s, 4s, 8s)
                    $baseDelay = 2000 * (2 ** ($attempt - 1));
                    
                    // Add jitter (±20%)
                    $jitterFactor = mt_rand(80, 120) / 100; // Random value between 0.8 and 1.2
                    $delay = $baseDelay * $jitterFactor;
                    
                    // Log each retry attempt
                    Log::info("Retry attempt {$attempt} for PageSpeed API. Waiting {$delay}ms before next attempt.");
                    
                    return $delay; // Return delay in milliseconds
                }, function ($exception, $request) {
                    // Log the exception details
                    Log::warning("PageSpeed API request failed: " . $exception->getMessage());
                    
                    // Always retry on any exception
                    return true;
                })
                ->get('https://www.googleapis.com/pagespeedonline/v5/runPagespeed', [
                    'url' => $url,
                    'key' => $apiKey,
                    'strategy' => 'mobile', // or 'desktop'
                ]);

            // Log success after retries (if any)
            Log::info("PageSpeed API request successful for URL: {$url}");
            
            if ($response->successful()) {
                $data = $response->json();

                // First check if we have all the parent keys we need
                if (!isset($data['lighthouseResult']) || 
                    !isset($data['lighthouseResult']['audits']) || 
                    !isset($data['lighthouseResult']['categories'])) {
                    
                    // Handle unexpected API response structure
                    $this->quickScan->update([
                        'performance_metrics' => ApiResult::fail(
                            json_encode($data),
                            "Invalid API response structure: missing required data fields"
                        ),
                    ]);
                    
                    Log::error('PageSpeed API returned unexpected structure: ' . json_encode($data));
                    return;
                }
                
                $audits = $data['lighthouseResult']['audits'];
                $categories = $data['lighthouseResult']['categories'];
                
                $metrics = [
                    'lcp' => $audits['largest-contentful-paint']['numericValue'] ?? null,
                    'fcp' => $audits['first-contentful-paint']['numericValue'] ?? null,
                    'ttfb' => $audits['server-response-time']['numericValue'] ?? null,
                    'cls' => $audits['cumulative-layout-shift']['numericValue'] ?? null,
                    'speed_index' => $audits['speed-index']['numericValue'] ?? null,
                    'total_blocking_time' => $audits['total-blocking-time']['numericValue'] ?? null,
                    'performance_score' => $categories['performance']['score'] ?? null,
                ];

                // Update performance metrics
                $this->quickScan->update([
                    'performance_metrics' => ApiResult::success($metrics),
                ]);
            } else {
                $this->quickScan->update([
                    'performance_metrics' => ApiResult::fail($response->body(),"Failed to fetch performance metrics: {$response->status()}"),
                ]);

                Log::error('PageSpeed API error: ' . $response->status() . ' - ' . $response->body());
            }
        } catch (\Exception $e) {
            $this->quickScan->update([
                'performance_metrics' => ApiResult::error("PageSpeed API exception: {$e->getMessage()}"),
            ]);

            Log::error('PageSpeed API exception: ' . $e->getMessage());
        }

        // Update progress regardless of outcome.
        $this->quickScan->addProgress(20);  // 20%
    }
}
