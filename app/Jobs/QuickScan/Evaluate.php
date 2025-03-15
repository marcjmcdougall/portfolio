<?php

namespace App\Jobs\QuickScan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use Symfony\Component\DomCrawler\Crawler;

use App\Models\QuickScan as QuickScanModel;

class Evaluate implements ShouldQueue
{
    use Queueable;

    protected Crawler $crawler;
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


        $this->evaluateHeaders();
        $this->evaluateImages();

        // Update the model with the new issues array
        $this->quickScan->update([
            'issues' => $this->issues,
            'info' => $this->info,
            'progress' => 90
        ]);
    }

    function evaluateHeaders() {
        // Get the first h1 content
        $h1 = $this->crawler->filter('h1')->first()->text();

        Log::info('Evaluating <h1> via OpenAI now...');

        // Evaluate clarity with OpenAI
        $instructionString = 'Please evaluate this text: "' . $h1 . '"';
        $this->askOpenAI('openai_h1_evaluation', $instructionString);

        $this->quickScan->update([
            'title' => $h1,
            'progress' => 30
        ]);
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

    function askOpenAI($label, $message) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.api_key'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'o3-mini', // Use the appropriate model
            'messages' => [
                [   
                    'role' => 'system', 
                    'content' => 'You are a conversion-rate optimization expert, and your goal is to evaluate any text sent to you for clarity, and judge whether or not it is likely to influence a user to move to the next step in a given marketing funnel.'
                ],
                [   
                    'role' => 'user', 
                    'content' => $message,
                ]
            ],
            'max_completion_tokens' => 1500,
        ]);

        // Check if the request was successful
        if ($response->successful()) {
            // Get the response body
            $responseData = $response->json();
            $generatedContent = $responseData['choices'][0]['message']['content'];
            
            $this->info[] = [
                $label => $generatedContent,
            ];

            // Use the generated content
            Log::info('OpenAI response: ' . $generatedContent);
        } else {
            // Handle error
            Log::error('OpenAI API error: ' . $response->status() . ' - ' . $response->body());
        }
    }
}
