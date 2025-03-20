<?php

namespace App\Http\Controllers;

use App\Models\QuickScan;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Jobs\QuickScan\QuickScan as QuickScanJob;

class QuickScanReportController extends Controller
{
    /**
     * Show a single QuickScan report.
     */
    public function show(string $id): View
    {
        $quickScan = QuickScan::findOrFail($id);
        
        // Process the messaging evaluation data
        $categories = $this->prepareEvaluationSections($quickScan);
        $performanceMetrics = $this->getPerformanceMetrics($quickScan);
        $overallScore = $quickScan->score ?? $this->calculateOverallScore($categories);

        if ($performanceMetrics && 'F' === $performanceMetrics['grade']) {
            $categories['meta']['sections']['overall']['takeaway'] = 'By far, the biggest impact on conversions here would be to optimize the site load time.';
        }
        
        return view('quick-scan.show', [
            'quickScan' => $quickScan,
            'categories' => $categories,
            'performanceMetrics' => $performanceMetrics,
            'overallScore' => $overallScore
        ]);
    }

    /**
     * Show a single QuickScan report.
     */
    public function create(): View
    {
        return view('quick-scan.create');
    }

    /**
     * Store a newly created quickscan in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url|max:255',
            'email' => 'required|email|max:255',
            'consent' => 'required'
        ]);

        $quickScan = new QuickScan();
        $quickScan->url = $request->url;
        $quickScan->email = $request->email;

        $quickScan->save();

        // Dispatch the job to start the scan
        QuickScanJob::dispatch($quickScan);

        return redirect()->route('quick-scan.show', $quickScan->id)
            ->with('success', 'Quickscan is running...');
    }

    /**
     * Define the category mappings for evaluation sections
     */
    protected function getCategoryMappings()
    {
        return [
            'meta' => [
                'title' => 'Meta',
                'sections' => ['overall', 'messaging', 'conversionChance']
            ],
            'messaging' => [
                'title' => 'Messaging',
                'sections' => ['valueProposition', 'headline']
            ],
            'socialProof' => [
                'title' => 'Social Proof & Trust',
                'sections' => ['socialProof', 'testimonials', 'associatedBrands', 'trustIndicators']
            ],
            'criticalPath' => [
                'title' => 'Critical Path',
                'sections' => ['primaryCTA', 'conflictingCTAs', 'conversionPath']
            ],
            'features' => [
                'title' => 'Features & Benefits',
                'sections' => ['features', 'featurePresentation', 'benefits', 'benefitPresentation']
            ],
            'other' => [
                'title' => 'Other Considerations',
                'sections' => [] // This will catch any sections not explicitly mapped
            ]
        ];
    }

    /**
     * Prepare evaluation sections organized by categories
     */
    protected function prepareEvaluationSections(QuickScan $quickScan)
    {
        // Get the raw evaluation data
        $evaluation = $quickScan->info['openai_messaging_evaluation'] ?? null;
        
        // Handle string vs json object inconsistency
        if (is_string($evaluation) && strpos($evaluation, '{') === 0) {
            $evaluation = json_decode($evaluation, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $evaluation = null;
            }
        }
        
        // Get category mappings
        $categoryMappings = $this->getCategoryMappings();
        
        // Initialize categories with empty section arrays
        $categories = [];
        foreach ($categoryMappings as $categoryKey => $category) {
            $categories[$categoryKey] = [
                'title' => $category['title'],
                'sections' => [],
                'averageRating' => 0,
            ];
            
            // Pre-populate each category with placeholder sections for all expected keys
            foreach ($category['sections'] as $sectionKey) {
                $categories[$categoryKey]['sections'][$sectionKey] = [
                    'key' => $sectionKey,
                    'title' => $this->formatSectionTitle($sectionKey),
                    'rating' => null,
                    'grade' => 'N/A',
                    'responseOptions' => '',
                    'analysis' => null,
                    'isPlaceholder' => true // Flag to identify placeholder sections
                ];
            }
        }
        
        // If we have actual evaluation data, process and overwrite placeholders
        if ($evaluation && is_array($evaluation)) {
            // Prepare sections with grades
            $processedSections = [];
            foreach ($evaluation as $key => $data) {
                $rating = $data['rating'] ?? null;
                $rating = $this->calibrateRating($key, $rating);
                
                $processedSections[$key] = [
                    'key' => $key,
                    'title' => $this->formatSectionTitle($key),
                    'rating' => $rating,
                    'grade' => $this->getLetterGrade($rating),
                    'responseOptions' => $data['responseOptions'] ?? '',
                    'analysis' => $data['analysis'] ?? null,
                    'isPlaceholder' => false
                ];
            }
            
            // Assign sections to categories (overwriting placeholders)
            $unmappedSections = [];
            foreach ($processedSections as $sectionKey => $section) {
                $assigned = false;
                
                // Try to find a category for this section
                foreach ($categoryMappings as $categoryKey => $category) {
                    if (in_array($sectionKey, $category['sections'])) {
                        $categories[$categoryKey]['sections'][$sectionKey] = $section;
                        $assigned = true;
                        break;
                    }
                }
                
                // If not assigned to a specific category, mark for "other"
                if (!$assigned) {
                    $unmappedSections[$sectionKey] = $section;
                }
            }
            
            // Add unmapped sections to "other" category
            if (!empty($unmappedSections)) {
                if (!isset($categories['other'])) {
                    $categories['other'] = [
                        'title' => 'Other Considerations',
                        'sections' => [],
                        'averageRating' => 0,
                    ];
                }
                
                foreach ($unmappedSections as $sectionKey => $section) {
                    $categories['other']['sections'][$sectionKey] = $section;
                }
            }
        }
        
        // Calculate average rating for each category
        foreach ($categories as $categoryKey => &$category) {
            $total = 0;
            $count = 0;
            
            foreach ($category['sections'] as $section) {
                if (isset($section['rating']) && !is_null($section['rating'])) {
                    $total += $section['rating'];
                    $count++;
                }
            }
            
            if ($count > 0) {
                $category['averageRating'] = round($total / $count);
            }
        }
        
        return $categories;
    }

    /**
     * Adds ad-hoc calibration to OpenAI response, which tends to be either
     * way too pessimistic or optimistic for certain categories.
     */
    protected function calibrateRating($key, $rating) {
        $calibratedRating = $rating + 15;
        if ( $calibratedRating > 100 ) $calibratedRating = 100;

        return $calibratedRating;
    }

    /**
     * Convert a numeric rating to a letter grade
     */
    protected function getLetterGrade($rating)
    {
        if ($rating === null) return 'N/A';
        
        if ($rating >= 90) return 'A';
        if ($rating >= 80) return 'B';
        if ($rating >= 70) return 'C';
        if ($rating >= 60) return 'D';
        return 'F';
    }
    
    /**
     * Format a section key into a human-readable title
     */
    protected function formatSectionTitle($key)
    {
        $title = preg_replace('/(?<=[a-z])(?=[A-Z])/', ' ', $key);
        return ucwords($title);
    }
    
    /**
     * Get performance metrics in a structured format
     */
    protected function getPerformanceMetrics(QuickScan $quickScan)
    {
        if (!isset($quickScan->info)) {
            return null;
        }

        if(isset($quickScan->info['performance_metrics'])) {
            $metrics = $quickScan->info['performance_metrics'];

                // Convert milliseconds to seconds for FCP and LCP
                if (isset($metrics['fcp'])) {
                    $metrics['fcp'] = round($metrics['fcp'] / 1000, 2);
                }
                
                if (isset($metrics['lcp'])) {
                    $metrics['lcp'] = round($metrics['lcp'] / 1000, 2);

                    $metrics['grade'] = 'N/A';

                    if ($metrics['lcp'] < 2) {
                        $metrics['grade'] = 'A';
                    } else if ($metrics['lcp'] < 4) {
                        $metrics['grade'] = 'B';
                    } else if ($metrics['lcp'] < 6) {
                        $metrics['grade'] = 'C';
                    } else if ($metrics['lcp'] < 10) {
                        $metrics['grade'] = 'D';
                    } else {
                        $metrics['grade'] = 'F';
                        // Todo: Say something in overview if performance is very bad.
                    }
                }

            return $metrics;
        }
        
        return null;
    }
    
    /**
     * Calculate an overall score from sections
     */
    protected function calculateOverallScore($categories)
    {
        if (empty($categories)) {
            return null;
        }
        
        $total = 0;
        $count = 0;
        
        foreach ($categories as $category) {
            foreach ($category['sections'] as $section) {
                if (isset($section['rating'])) {
                    $total += $section['rating'];
                    $count++;
                }
            }
        }
        
        return $count > 0 ? round($total / $count) : null;
    }
}
