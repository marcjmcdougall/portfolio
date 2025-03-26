<?php

namespace App\Jobs\QuickScan;

use App\Helpers\ApiResult;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

use Symfony\Component\DomCrawler\Crawler;

use App\Models\QuickScan;

class EvaluateImages implements ShouldQueue
{
    use Queueable, Batchable;

    protected Crawler $crawler;
    protected $issues = [];

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
        $this->crawler = new Crawler($this->quickScan->html_content->getValue());

        $count = 0;
        $totalImageSize = 0;
        Log::info('Evaluating images now..');

        // Process all images
        $this->crawler->filter('img')->each(function (Crawler $image) use (&$count, &$totalImageSize) {
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
                        $totalImageSize += $fileSizeKB;

                        Log::info('Image size: ' . $fileSizeKB);
                        
                        // Todo: Check data-bg too.
                        // Check if file is too large
                        if ($fileSizeKB > 500) {
                            // Add issue
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

        $currentHTMLSize = $this->quickScan->html_size->getValue();
        $newHTMLSize = $currentHTMLSize + $totalImageSize;

        // Update the total image size and image count fields.
        $this->quickScan->update([
            'image_count' => ApiResult::success(
                $count,
            ),
            'html_size' => ApiResult::success(
                $newHTMLSize
            )
        ]);

        $this->quickScan->addIssues($this->issues);
        $this->quickScan->addProgress(20);
    }
}
