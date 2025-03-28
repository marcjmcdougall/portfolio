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

class EvaluateMarkup implements ShouldQueue
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
                    'justification' => 'If vision-impaired persons cannot consume your content, they definitely won\t convert',
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
                                'justification' => 'Large images reduce your perceived load time significantly',
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

        // Todo: Evaluate contrast issues with Chromium
        $this->evaluateContrastIssues();

        // Determine size of site with images
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

    private function evaluateContrastIssues(){
        // Target interactive elements
        $interactiveSelectors = [
            'a', 'button', 'input[type="button"]', 'input[type="submit"]',
            '.btn', '.button', '[role="button"]', '[tabindex]'
        ];

        $interactiveElements = $this->crawler->filter(implode(', ', $interactiveSelectors));
    
        $interactiveElements->each(function (Crawler $element, $i) use (&$issues) {
            // Get text content
            $text = trim($element->text());
            if (empty($text)) {
                // Skip elements without text
                return;
            }
            
            // Extract inline styles if present
            $style = $element->attr('style') ?? '';
            $elementHtml = $element->outerHtml();
            
            // Extract colors from inline styles
            $textColor = $this->extractColor($style, 'color');
            $bgColor = $this->extractColor($style, 'background-color');
            
            // If no inline colors, try to get computed styles using class names
            // Note: This is a simplification; full implementation would need browser rendering
            if (!$textColor || !$bgColor) {
                $classes = $element->attr('class') ?? '';
                // Extract potential color classes (this is site-specific and needs customization)
                // For example, Tailwind classes like "text-white" or "bg-blue-500"
                $textColor = $textColor ?: $this->extractColorFromClasses($classes, 'text');
                $bgColor = $bgColor ?: $this->extractColorFromClasses($classes, 'bg');
            }
            
            // If we found both colors, calculate contrast
            if ($textColor && $bgColor) {
                $ratio = $this->calculateContrastRatio($textColor, $bgColor);
                
                // WCAG requires at least 4.5:1 for normal text, 3:1 for large text
                $isLargeText = $this->isLargeText($style);
                $minimumRatio = $isLargeText ? 3 : 4.5;
                
                if ($ratio < $minimumRatio) {
                    $issues[] = [
                        'element' => $this->describeElement($element),
                        'text' => $text,
                        'textColor' => $textColor,
                        'bgColor' => $bgColor,
                        'contrastRatio' => $ratio,
                        'requiredRatio' => $minimumRatio,
                        'isLargeText' => $isLargeText
                    ];
                }
            }
        });
    }

    /**
     * Extract color from inline style
     */
    private function extractColor($style, $property)
    {
        if (preg_match('/' . $property . ':\s*([^;]+)/i', $style, $matches)) {
            return $this->normalizeColor($matches[1]);
        }
        return null;
    }

    /**
     * Convert color to RGB format for calculations
     */
    private function normalizeColor($color)
    {
        // Handle hex colors
        if (preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/i', $color)) {
            if (strlen($color) == 4) {
                $r = hexdec(substr($color, 1, 1) . substr($color, 1, 1));
                $g = hexdec(substr($color, 2, 1) . substr($color, 2, 1));
                $b = hexdec(substr($color, 3, 1) . substr($color, 3, 1));
            } else {
                $r = hexdec(substr($color, 1, 2));
                $g = hexdec(substr($color, 3, 2));
                $b = hexdec(substr($color, 5, 2));
            }
            return [$r, $g, $b];
        }
        
        // Handle rgb/rgba colors
        if (preg_match('/rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*[\d.]+)?\)/i', $color, $matches)) {
            return [(int)$matches[1], (int)$matches[2], (int)$matches[3]];
        }
        
        // Handle named colors (simplified - would need a full color map)
        $colorMap = [
            'black' => [0, 0, 0],
            'white' => [255, 255, 255],
            'red' => [255, 0, 0],
            'green' => [0, 128, 0],
            'blue' => [0, 0, 255],
            // Add more as needed
        ];
        
        return $colorMap[strtolower($color)] ?? null;
    }

    /**
     * Calculate WCAG contrast ratio
     */
    private function calculateContrastRatio($color1, $color2)
    {
        $l1 = $this->calculateRelativeLuminance($color1);
        $l2 = $this->calculateRelativeLuminance($color2);
        
        // Ensure lighter color is l1
        if ($l2 > $l1) {
            list($l1, $l2) = [$l2, $l1];
        }
        
        return ($l1 + 0.05) / ($l2 + 0.05);
    }

    /**
     * Calculate relative luminance per WCAG formula
     */
    private function calculateRelativeLuminance($rgb)
    {
        list($r, $g, $b) = $rgb;
        
        $r = $r / 255;
        $g = $g / 255;
        $b = $b / 255;
        
        $r = $r <= 0.03928 ? $r / 12.92 : pow(($r + 0.055) / 1.055, 2.4);
        $g = $g <= 0.03928 ? $g / 12.92 : pow(($g + 0.055) / 1.055, 2.4);
        $b = $b <= 0.03928 ? $b / 12.92 : pow(($b + 0.055) / 1.055, 2.4);
        
        return 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;
    }

    /**
     * Check if text is considered "large" by WCAG (18pt or 14pt bold)
     */
    private function isLargeText($style)
    {
        // Simple check for font size in style
        if (preg_match('/font-size:\s*(\d+)pt/i', $style, $matches)) {
            return (int)$matches[1] >= 18;
        }
        
        if (preg_match('/font-size:\s*(\d+)px/i', $style, $matches)) {
            return (int)$matches[1] >= 24; // 18pt ≈ 24px
        }
        
        // If we find bold text with font size
        if (strpos($style, 'font-weight: bold') !== false || 
            strpos($style, 'font-weight: 700') !== false) {
            
            if (preg_match('/font-size:\s*(\d+)pt/i', $style, $matches)) {
                return (int)$matches[1] >= 14;
            }
            
            if (preg_match('/font-size:\s*(\d+)px/i', $style, $matches)) {
                return (int)$matches[1] >= 18.67; // 14pt ≈ 18.67px
            }
        }
        
        return false;
    }

    /**
     * Create a readable description of an element
     */
    private function describeElement(Crawler $element)
    {
        $tag = $element->nodeName();
        $id = $element->attr('id') ? "#{$element->attr('id')}" : '';
        $classes = $element->attr('class') ? ".{$element->attr('class')}" : '';
        
        return "{$tag}{$id}{$classes}";
    }
}
