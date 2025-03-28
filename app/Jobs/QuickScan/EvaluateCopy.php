<?php

namespace App\Jobs\QuickScan;

use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

use Symfony\Component\DomCrawler\Crawler;

use App\Helpers\OpenAIController;
use App\Models\QuickScan;
use App\Helpers\ApiResult;

class EvaluateCopy implements ShouldQueue
{
    use Queueable, Batchable;

    protected OpenAIController $openAi;
    protected Crawler $crawler;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public QuickScan $quickScan
    )
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->crawler = new Crawler($this->quickScan->html_content->getValue());
        $this->openAi = new OpenAIController(true);

        // Evaluate messaging efficacy
        $bodyHtml = $this->crawler->filter('body')->outerHtml();

        try {
            // Create thread & upload the HTML to the thread
            $this->openAi->createThreadWithFile($bodyHtml, $this->quickScan->domain . '.html');
        } catch (\Exception $e) {
            $this->quickScan->update([
                'openai_messaging_audit' => ApiResult::error("Failed to evaluate copy: " . $e->getMessage()),
            ]);

            // Add progress regardless of outcome
            $this->quickScan->addProgress(50);

            // Hault execution.
            return;
        }

        $copyEvaluationInstructions = 'Evaluate the HTML file I\'ve attached and provide an analysis of the website\'s conversion optimization elements. 
            You MUST respond with a valid JSON object using exactly the following format:
            {
                "messaging": {
                    "analysis": "Your overall thoughts on the messaging of this site, persuant to what you believe the website is trying to achieve.",
                    "responseOptions": "`Clear & direct`, `Mostly clear`, `Needs improvement`, or `Lacks focus`",
                    "rating": 0
                },
                "valueProposition": {
                    "analysis": "Your detailed analysis of the website\'s primary value proposition",
                    "rating": 0
                },
                "headline": {
                    "analysis": "Your evaluation of the primary H1 element for clarity and conciseness",
                    "rating": 0
                },
                "primaryCTA": {
                    "analysis": "Your analysis of the main call-to-action",
                    "rating": 0
                },
                "conflictingCTAs": {
                    "analysis": "Your assessment of any competing or conflicting calls-to-action",
                    "rating": 0
                },
                "features": {
                    "analysis": "Your identification of the core product/service features discussed",
                    "rating": 0
                },
                "benefits": {
                    "analysis": "Your analysis of how well the site connects features to customer benefits",
                    "rating": 0
                },
                "benefitPresentation": {
                    "analysis": "Your evaluation of how benefits are presented and emphasized",
                    "rating": 0
                },
                "socialProof": {
                    "analysis": "Your assessment of testimonials, case studies, or other social proof elements.  If you find any case studies, please increase your rating for this category significantly",
                    "rating": 0
                },
                "associatedBrands": {
                    "analysis": "Your assessment of any associated brand images found on the page. Specifically: discuss their placement on the page.  If you find brand logos lower down in the HTML, this is a problem.",
                    "rating": 0
                }
                "overall": {
                    "analysis": "Your overall thoughts on what this website is trying to achieve and how well it does so",
                    "rating": 0
                },
                "conversionChance": {
                    "analysis": "Your overall thoughts on the likelihood of a site visitor ending up as a customer via this landing page.",
                    "responseOptions": "`Very likely`, `Likely`, `Somewhat Likely`, `Unlikely`, or `Very unlikely`"
                    "rating": 0
                },
                "mainImprovement": {
                    "analysis": "List briefly the ONE thing that this website should focus on to improve the likelyhood of a customer signup.",
                },
            }

            IMPORTANT: The rating numbers shown above are PLACEHOLDERS ONLY. You must evaluate each element based on your expert analysis of the actual website content and assign ratings that genuinely reflect the quality of each element.

            For each category, provide:
            1. A concise but thorough analysis (100-150 words)
            2. A numerical rating from 0-100, where:
            - 0-20: Extremely poor or completely missing
            - 21-40: Poor implementation with significant issues
            - 41-60: Average implementation with clear room for improvement
            - 61-80: Good implementation with minor opportunities for enhancement
            - 81-100: Excellent implementation

            DO NOT copy the example ratings. Each rating must be your own assessment based on the actual content of the website.

            For each category, if you find a field named "responseOptions", your analysis MUST use ONE AND ONLY ONE of the text strings provided for that category.  Choose the one that seems most appropriate given your rating.  

            Your response MUST be a properly formatted JSON object as specified above with no additional text before or after.';

        // Update field.
        try {
            $response = $this->openAi->ask($copyEvaluationInstructions);

            // \Log::debug('Raw response: ' . bin2hex(substr($response, 0, 30)));

            // Check if the response is not in the expected format
            if ( ! $this->isValidJsonResponse($response) ) {
                // Use partial success - the API call worked but result is unusable
                $this->quickScan->update([
                    'openai_messaging_audit' => ApiResult::fail(
                        $response,
                        'Response was not in expected JSON format'
                    ),
                ]);

                \Log::info("Failed response from OpenAI: " .  print_r($response, true));
            } else {
                // Normal success case
                $this->quickScan->update([
                    'openai_messaging_audit' => ApiResult::success($response),
                ]);

                \Log::info("Successful response from OpenAI:" .  print_r($response, true));
            }
        } catch (\Exception $e) {
            $this->quickScan->update([
                'openai_messaging_audit' => ApiResult::error("Failed to evaluate copy: " . $e->getMessage()),
            ]);

            \Log::info("Exception during EvaluateCopy: " . $e->getMessage());

            // Add progress regardless of outcome
            $this->quickScan->addProgress(50);

            return;
        }

        // Add progress regardless of outcome
        $this->quickScan->addProgress(50);
    }


    // Helper method to check if response is valid JSON
    private function isValidJsonResponse($response) {
        // If it's already an array, it's already been processed as JSON
        if (is_array($response)) {
            return true;
        }
        
        if (!is_string($response)) {
            return false;
        }
        
        // Rest of your validation for strings
        try {
            json_decode($response, true, 512, JSON_THROW_ON_ERROR);
            return true;
        } catch (\JsonException $e) {
            \Log::debug('JSON error: ' . $e->getMessage());
            return false;
        }
    }
}
