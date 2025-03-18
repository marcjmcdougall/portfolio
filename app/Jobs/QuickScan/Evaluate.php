<?php

namespace App\Jobs\QuickScan;

use App\Helpers\OpenAIController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Bus;
use Throwable;

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
        // Initialize the OpenAI controller with Assistant API enabled
        $this->openAi = new OpenAIController(true);


        $this->evaluateCopy();
        $this->evaluateImages();
        $this->evaluateLoadTime();

        // Update the model with the new issues array
        $this->quickScan->update([
            'issues' => $this->issues,
            'info' => $this->info,
            'status' => 'completed',
            'progress' => 100
        ]);

        Log::info('OpenAI message history: ' . print_r($this->openAi->getMessageHistory(), true));
    }

    function evaluateCopy() {
        // Evaluate messaging efficacy
        // $bodyHtml = $this->crawler->filter('body')->outerHtml();
        $bodyHtml = $this->crawler->filter('body')->outerHtml();

        // Creat thread & upload the HTML to the thread
        $this->openAi->createThreadWithFile($bodyHtml, $this->quickScan->title . '.html');

        $copyEvaluationInstructions = 'Evaluate the HTML file I\'ve attached and provide an analysis of the website\'s conversion optimization elements. 
            You MUST respond with a valid JSON object using exactly the following format:
            {
            "valueProposition": {
                "analysis": "Your detailed analysis of the website\'s primary value proposition",
                "rating": 85
            },
            "headline": {
                "analysis": "Your evaluation of the primary H1 element for clarity and conciseness",
                "rating": 70
            },
            "primaryCTA": {
                "analysis": "Your analysis of the main call-to-action",
                "rating": 90
            },
            "conflictingCTAs": {
                "analysis": "Your assessment of any competing or conflicting calls-to-action",
                "rating": 65
            },
            "features": {
                "analysis": "Your identification of the core product/service features discussed",
                "rating": 80
            },
            "benefits": {
                "analysis": "Your analysis of how well the site connects features to customer benefits",
                "rating": 75
            },
            "benefitPresentation": {
                "analysis": "Your evaluation of how benefits are presented and emphasized",
                "rating": 60
            },
            "socialProof": {
                "analysis": "Your assessment of testimonials, case studies, or other social proof elements",
                "rating": 50
            }
            }

            For each category, provide:
            1. A concise but thorough analysis (100-150 words)
            2. A numerical rating from 0-100, where:
            - 0-20: Extremely poor or completely missing
            - 21-40: Poor implementation with significant issues
            - 41-60: Average implementation with clear room for improvement
            - 61-80: Good implementation with minor opportunities for enhancement
            - 81-100: Excellent implementation

            Your response MUST be a properly formatted JSON object as specified above with no additional text before or after.';

        // Todo build a JSON array for the input first, so ChatGPT knows how to format the response.

        $this->info['openai_messaging_evaluation'] = 
            $this->openAi->ask($copyEvaluationInstructions);

        $this->quickScan->update([
            'progress' => 50
        ]);
    }

    function evaluateImages() {
        $count = 0;

        Log::info('Evaluating images now..');

        // Process all images
        $this->crawler->filter('img')->each(function (Crawler $image) use (&$count) {
            $src = $image->attr('src');
            $alt = $image->attr('alt');

            // Check for missing alt tags
            if ($alt === null || $alt === '') {
                $this->issues[] = [
                    'type' => 'missing_alt_tag',
                    'severity' => 'medium',
                    'description' => 'Image missing alt text: ' . $src,
                    'location' => $image->outerHtml()
                ];
            }
            
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
