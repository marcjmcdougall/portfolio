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
            $response = Http::timeout(120)->get('https://www.googleapis.com/pagespeedonline/v5/runPagespeed', [
                'url' => $url,
                'key' => $apiKey,
                'strategy' => 'mobile', // or 'desktop'
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                
                $metrics = [
                    'lcp' => $data['lighthouseResult']['audits']['largest-contentful-paint']['numericValue'] ?? null,
                    'fcp' => $data['lighthouseResult']['audits']['first-contentful-paint']['numericValue'] ?? null,
                    'ttfb' => $data['lighthouseResult']['audits']['server-response-time']['numericValue'] ?? null,
                    'cls' => $data['lighthouseResult']['audits']['cumulative-layout-shift']['numericValue'] ?? null,
                    'speed_index' => $data['lighthouseResult']['audits']['speed-index']['numericValue'] ?? null,
                    'total_blocking_time' => $data['lighthouseResult']['audits']['total-blocking-time']['numericValue'] ?? null,
                    'performance_score' => $data['lighthouseResult']['categories']['performance']['score'] ?? null,
                ];

                // Update performance metrics
                $this->quickScan->update([
                    'performance_metrics' => ApiResult::success($metrics),
                ]);

                // Update progress.
                $this->quickScan->addProgress(20);  // 20%
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
    }
}
