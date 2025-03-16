<?php

namespace App\Jobs\QuickScan;

use App\Helpers\OpenAIController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Support\Facades\Http;

use App\Models\QuickScan as QuickScanModel;

class Evaluate implements ShouldQueue
{
    use Queueable;

    protected Crawler $crawler;
    protected OpenAIController $openAi;
    protected array $issues = [];
    protected array $info = [];

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
        // Initialize the crawler
        $this->crawler = new Crawler($this->quickScan->html_content);
        $this->openAi = new OpenAIController();

        $this->evaluateCopy();
        $this->evaluateImages();
        $this->evaluateLoadTime();

        // Update the model with the new issues array
        $this->quickScan->update([
            'issues' => $this->issues,
            'info' => $this->info,
            'status' => 'complete',
            'progress' => 100
        ]);

        Log::info('OpenAI message history: ' . print_r($this->openAi->getMessageHistory(), true));
    }

    function evaluateCopy() {
        // Evaluate messaging efficacy
        $bodyHtml = $this->crawler->filter('body')->outerHtml();
        $clarityEvalInstruction = 'Please evaluate the flow of the text on this page, taking special note 
        of any opportunities to improve the ability of the copy to influence the reader to move to the next 
        step in the funnel.  Specifically, you are looking for a few things:
            1. Understand the primary value proposition of the website.
            2. Evaluate the content of the primary <h1> element on the site to see if it is clear and concise.
            3. Determine the primary call-to-action on the site.
            4. Any conflicting call-to-actions that may disrupt this primary pathway.
            5. Disvover any discussion of the core features of the app.
            6. Once features have been discovered, try to reverse-engineer what the benefit to the customer of said features may be.
            7. Try to determine if those benefits are discussed anywhere on the site.
            8. Look for evidence of social proof, or tangible results on the site.
        Please evaluate the following content: ' . $bodyHtml;

        $this->info['openai_messaging_evaluation'] = 
            $this->openAi->ask($clarityEvalInstruction);

        // Get the first h1 content
        $h1 = $this->crawler->filter('h1')->first()->text();

        Log::info('Evaluating <h1> via OpenAI now...');

        $this->quickScan->update([
            'title' => $h1,
            'progress' => 30
        ]);

        $this->info['openai_h1_rating'] = 
            $this->openAi->ask('Can you rate the primary <h1> out of 10?  10 being the best you\'ve ever seen.  Please respond with the number only.');
    }

    function evaluateImages() {
        $count = 0;

        // Process all images
        $this->crawler->filter('img')->each(function (Crawler $image) use (&$count) {
            $src = $image->attr('src');
            $alt = $image->attr('alt');
            
            Log::info('Checking image alt tags now...');

            // Check for missing alt tags
            if ($alt === null || $alt === '') {
                $this->issues[] = [
                    'type' => 'missing_alt_tag',
                    'severity' => 'medium',
                    'description' => 'Image missing alt text: ' . $src,
                    'location' => $image->outerHtml()
                ];
            }

            Log::info('Checking image file size now...');
            
            // Process image size check
            // Convert relative URLs to absolute
            if (strpos($src, 'http') !== 0 && strpos($src, '//') !== 0) {
                $baseUrl = parse_url($this->quickScan->url, PHP_URL_SCHEME) . '://' . 
                        parse_url($this->quickScan->url, PHP_URL_HOST);
                $src = rtrim($baseUrl, '/') . '/' . ltrim($src, '/');
            }
            
            try {
                // Use Laravel's HTTP client to get headers only
                $response = Http::withOptions([
                    'connect_timeout' => 5,
                ])->head($src);
                
                if ($response->successful()) {
                    $contentLength = $response->header('Content-Length');
                    
                    if ($contentLength) {
                        // Convert bytes to KB
                        $fileSizeKB = round($contentLength / 1024, 2);

                        Log::info('Image size: ' . $fileSizeKB);
                        
                        // Todo: Check data-bg too.
                        // Check if file is too large
                        if ($fileSizeKB > 500) {
                            $this->issues[] = [
                                'type' => 'large_image_file',
                                'severity' => 'medium',
                                'description' => "Image file is too large: {$fileSizeKB}KB",
                                'location' => $src
                            ];
                        }
                    }
                }
            } catch (\Exception $e) {
                Log::warning("Could not check image file size: {$src}");
            }

            $count++;
        });

        Log::info('Total images found: ' . $count);

        $this->info[] = [
            'image_count' => $count,
        ];
    }

    function evaluateLoadTime() {
        $url = $this->quickScan->url;
        $apiKey = config('services.google.pagespeed_api_key');

        Log::info('Evaluating page speed now... ');
        
        $response = Http::get('https://www.googleapis.com/pagespeedonline/v5/runPagespeed', [
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
            
            $this->info[] = [
                'performance_metrics' => $metrics
            ];
        }
    }
}
