<?php

namespace App\Jobs\QuickScan;

use App\Helpers\GeminiController;
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

        if('openai' === config('app.llm.provider')) {
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
        }

        $copyEvaluationInstructions = config('prompts.openai.copy_evaluation');

        // Update field.
        try {
            if('openai' === config('app.llm.provider')) {
                $response = $this->openAi->ask($copyEvaluationInstructions);
            } else if ('gemini' === config('app.llm.provider')){
                // Instantiate and run Gemini
                $gemini = new GeminiController();
                $response = $gemini->askWithFile($bodyHtml, $this->quickScan->domain . '.html');
            }

            // Check if the response is not in the expected format
            if ( ! $this->isValidJsonResponse($response) ) {
                // Use partial success - the API call worked but result is unusable
                $this->quickScan->update([
                    'openai_messaging_audit' => ApiResult::fail(
                        $response,
                        'Response was not in expected JSON format'
                    ),
                ]);

                \Log::info("Failed response from OpenAI ({$this->quickScan->id}): " .  print_r($response, true));
            } else {
                // Normal success case
                $this->quickScan->update([
                    'openai_messaging_audit' => ApiResult::success($response),
                ]);

                \Log::info("Successful response from OpenAI ({$this->quickScan->id}):" .  print_r($response, true));
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
