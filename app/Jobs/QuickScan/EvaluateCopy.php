<?php

namespace App\Jobs\QuickScan;

use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

use Symfony\Component\DomCrawler\Crawler;

use App\Helpers\OpenAIController;
use App\Models\QuickScan;

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
        $this->crawler = new Crawler($this->quickScan->html_content);
        $this->openAi = new OpenAIController(true);

        // Evaluate messaging efficacy
        // $bodyHtml = $this->crawler->filter('body')->outerHtml();
        $bodyHtml = $this->crawler->filter('body')->outerHtml();

        // Creat thread & upload the HTML to the thread
        $this->openAi->createThreadWithFile($bodyHtml, $this->quickScan->title . '.html');

        $copyEvaluationInstructions = 'Evaluate the HTML file I\'ve attached and provide an analysis of the website\'s conversion optimization elements. 
            You MUST respond with a valid JSON object using exactly the following format:
            {
                "overall": {
                    "analysis": "Your overall thoughts on what this website is trying to achieve and how well it does so",
                    "rating": 0
                },
                "conversionChance": {
                    "analysis": "Your overall thoughts on the likelihood of a site visitor ending up as a customer via this landing page.",
                    "responseOptions": "`Very likely`, `Likely`, `Somewhat Likely`, `Unlikely`, or `Very unlikely`"
                    "rating": 0
                },
                "messaging": {
                    "analysis": "Your overall thoughts on the messaging of this site, persuant to what you believe the website is trying to achieve.",
                    "responseOptions": "`Clear & direct`, `Needs improvement`, or `Lacks focus`",
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

        // Update info field.
        $this->quickScan->setInfo(
            'openai_messaging_evaluation',
            $this->openAi->ask($copyEvaluationInstructions)
        );
    }
}
