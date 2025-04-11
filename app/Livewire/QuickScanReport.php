<?php

namespace App\Livewire;

use App\Models\QuickScan;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class QuickScanReport extends Component
{
    public $quickScan;
    public $readableURL;
    public $relativeURLPaths;
    public $categories;
    public $performanceMetrics;
    public $overallScore;

    public $completeOnLoad = false;

    public $eventTracked = false;

    public function mount($quickScan)
    {
        $this->quickScan = $quickScan;

        // Used to conditionally show the progress notifier
        if('completed' === $this->quickScan->status) $this->completeOnLoad = true;
    }

    public function render()
    {
        $this->processData();
        $this->trackEventOnce();

        return view('livewire.quick-scan-report', [
            'shouldPoll' => (
                $this->quickScan->status === 'processing' ||
                $this->quickScan->status === 'queued'
            ),
        ]);
    }

    public function trackEventOnce() {
        // First check if we've already tracked in this specific instance
        if (isset( $this->eventTracked ) && $this->eventTracked) {
            return;
        }

        if ( ! $this->quickScan->tracked ) {
            // Add a local flag to prevent duplicate tracking within the same instance
            $this->eventTracked = true;
            
            // Logs event to Fathom Analytics
            $this->dispatch('scan-finished', eventName: config('services.fathom.event_name' ));

            Log::info('Dispatching Fathom event for ' . $this->quickScan->domain);
            
            // Update status
            $this->quickScan->update([
                'tracked' => true
            ]);
        }
    }

    public function updated($name, $value)
    {
        // If the status was updated to "completed".
        if ($name === 'quickScan.status' && $value === 'completed') {
            Log::info('QuickScan completed, processing one last time...');

            // Process data one final time
            $this->processData();
        }
    }

    public function processData()
    {
        // Process the messaging evaluation & performance data
        $this->categories = $this->prepareEvaluationSections($this->quickScan);
        $this->performanceMetrics = $this->getPerformanceMetrics($this->quickScan);
        $this->overallScore = $this->quickScan->score ?? $this->calculateOverallScore($this->categories);

        if ($this->performanceMetrics && 'F' === $this->performanceMetrics['grade']) {
            $this->categories['meta']['sections']['overall']['takeaway'] = 'By far, the biggest impact on conversions here would be to optimize the site load time.';
        }
    }

    /**
     * Define the category mappings for evaluation sections
     */
    protected function getCategoryMappings()
    {
        return [
            'meta' => [
                'title' => 'Meta',
                'sections' => ['overall', 'messaging', 'conversionChance', 'mainImprovement']
            ],
            'messaging' => [
                'title' => 'Messaging',
                'sections' => ['valueProposition', 'headline']
            ],
            'socialProof' => [
                'title' => 'Social Proof & Trust',
                'sections' => ['socialProof', 'associatedBrands']
            ],
            'criticalPath' => [
                'title' => 'Critical Path',
                'sections' => ['primaryCTA', 'conflictingCTAs']
            ],
            'features' => [
                'title' => 'Features & Benefits',
                'sections' => ['features', 'benefits', 'benefitPresentation']
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
        $evaluationResult = $quickScan->openai_messaging_audit;
        $evaluation = $evaluationResult->getValue();
        
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
                // Todo: Low performance should impact conversion potential here
                $categories[$categoryKey]['sections'][$sectionKey] = [
                    'key' => $sectionKey,
                    'title' => $this->formatSectionTitle($sectionKey),
                    'rating' => null,
                    'grade' => 'N/A',
                    'responseOptions' => '',
                    'analysis' => null,
                    'isPlaceholder' => true, // Flag to identify placeholder sections
                    'status' => 'processing',
                ];
            }
        }
        
        // If we have actual evaluation data, process and overwrite placeholders
        if ($evaluationResult->isSuccess() && is_array($evaluation)) {
            // Prepare sections with grades
            $processedSections = [];
            foreach ($evaluation as $key => $data) {
                $rating = $data['rating'] ?? null;

                // Calibrate rating for OpenAI (very pessimistic)
                if('openai' === config('app.llm.provider')) {
                    $rating = $this->calibrateRating($key, $rating);
                }
                
                $processedSections[$key] = [
                    'key' => $key,
                    'title' => $this->formatSectionTitle($key),
                    'rating' => $rating,
                    'grade' => $this->getLetterGrade($rating),
                    'responseOptions' => $data['responseOptions'] ?? '',
                    'analysis' => $data['analysis'] ?? null,
                    'isPlaceholder' => false,
                    'data' => $data, // Pass the data to parse in the template on ad-hoc items
                    'status' => 'success'
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
                if ( ! $assigned ) {
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
        elseif ($evaluationResult->isFail() && is_string($evaluation)) {
            Log::info('String response found!');
            // OpenAI has returned some psuedo-failure response like "cannot find file"
            foreach ($categoryMappings as $categoryKey => $category) {
                $sections = $categories[$categoryKey]['sections'];

                foreach ($sections as $sectionKey => $sectionValue) {
                    $categories[$categoryKey]['sections'][$sectionKey]['status'] = 'error';
                }
            }

            Log::info(print_r($categories, true));
        }
        
        // Calculate average rating for each category
        // foreach ($categories as $categoryKey => &$category) {
        //     $total = 0;
        //     $count = 0;
            
        //     foreach ($category['sections'] as $section) {
        //         if (isset($section['rating']) && !is_null($section['rating'])) {
        //             $total += $section['rating'];
        //             $count++;
        //         }
        //     }
            
        //     if ($count > 0) {
        //         $category['averageRating'] = round($total / $count);
        //     }
        // }
        
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
        if($quickScan->performance_metrics->isSuccess()) {
            $metrics = $quickScan->performance_metrics->getValue();

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
