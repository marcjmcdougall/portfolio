<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;

use App\Models\ApiUsage;


/**
 * OpenAIController - A helper class for interacting with OpenAI's APIs
 * 
 * This class now supports both the Chat Completions API and the Assistants API.
 * It maintains conversation history and provides methods to:
 * 
 * - Send messages via Chat Completions API
 * - Create and interact with Assistant threads
 * - Upload files to threads
 * - Retrieve responses from Assistant API
 * 
 * Usage example for Assistants API:
 * ```
 * $ai = new OpenAIController();
 * $ai->createThread();
 * $ai->uploadHtmlToThread('<html>...</html>', 'page.html');
 * $response = $ai->ask("Please evaluate this landing page");
 * ```
 * 
 * @package App\Helpers
 */
class GeminiController
{
    // Retry settings
    protected $maxRetries = 4;
    protected $retryDelay = 100; // Base delay in milliseconds
    protected $maxRetryDelay = 30000; // Max delay in milliseconds (30 seconds)
    
    public function __construct() {}

    public function askWithFile($html, $filename = 'page.html') {
        $apiKey = config('services.google.gemini_api_key');
        $model = config('services.google.gemini_model', 'gemini-2.0-flash');
        $message = config('prompts.openai.copy_evaluation');
        $responseSchema = [
            'type' => 'OBJECT',
            'properties' => [
                'messaging' => [
                    'type' => 'OBJECT',
                    'description' => 'Analysis of website messaging clarity and focus.',
                    'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Overall thoughts on the messaging of this site.'],
                        'responseOptions' => ['type' => 'STRING', 'description' => 'Should be one of: `Clear & direct`, `Mostly clear`, `Needs improvement`, or `Lacks focus`.'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Numerical rating of messaging effectiveness.'],
                    ],
                    'required' => ['analysis', 'responseOptions', 'rating']
                ],
                'emotionalLanguage' => [
                    'type' => 'OBJECT',
                    'description' => 'Does the site use emotional language that will make the reader motivated to take action to solve their problem instead of putting it off?',
                    'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Does the site use emotional language that will make the reader motivated to take action to solve their problem instead of putting it off?'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Numerical rating of usage of emotional language.'],
                    ],
                    'required' => ['analysis', 'rating']
                ],
                'valueProposition' => [
                    'type' => 'OBJECT',
                    'description' => 'Analysis of the website\'s primary value proposition.',
                    'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Detailed analysis of the website\'s primary value proposition.'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Numerical rating of value proposition clarity.'],
                    ],
                    'required' => ['analysis', 'rating']
                ],
                'funnelCohesion' => [
                    'type' => 'OBJECT',
                    'description' => 'Does the language of the primary CTA of the site match the problem being solved by this landing page?',
                    'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Does the language of the primary CTA of the site match the problem being solved by this landing page?'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Numerical rating of how well the call-to-action matches the offer'],
                    ],
                    'required' => ['analysis', 'rating']
                ],
                'activationEnergy' => [
                    'type' => 'OBJECT',
                    'description' => 'Does the language of the primary CTA of the site match the problem being solved by this landing page?',
                    'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Does it seem like it will take a significant effort to benefit from the product or service being offered here?  Please note that scheduling a consultation or a demo is considered moderately high energy due to the potential for a sales pitch.'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Numberical rating depicting how much effort is required to  benefit from the product or service.  For ratings, higher ratings mean less overall energy'],
                    ],
                    'required' => ['analysis', 'rating']
                ],
                'headline' => [
                    'type' => 'OBJECT',
                    'description' => 'Evaluation of the primary H1 element.',
                    'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Evaluation of the primary <h1> element for clarity and conciseness.'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Numerical rating of headline effectiveness.'],
                        'headlineValue' => [
                            'type' => 'OBJECT',
                            'properties' => [
                                'current' => ['type' => 'STRING', 'description' => 'The exact text content of the first <h1> element found.'],
                                'suggested' => ['type' => 'STRING', 'description' => 'A suggested, improved H1 text using normal casing.'],
                            ],
                            'required' => ['current', 'suggested']
                        ]
                    ],
                    'required' => ['analysis', 'rating', 'headlineValue']
                ],
                'primaryCTA' => [
                    'type' => 'OBJECT',
                    'description' => 'Analysis of the main call-to-action.',
                    'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Analysis of the main call-to-action (first non-nav button/link).'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Numerical rating of CTA effectiveness.'],
                        'primaryCTAValue' => [
                            'type' => 'OBJECT',
                            'properties' => [
                                'current' => ['type' => 'STRING', 'description' => 'The text content of the primary CTA element.'],
                                'suggested' => ['type' => 'STRING', 'description' => 'A suggested, improved primary CTA text using normal casing.'],
                            ],
                            'required' => ['current', 'suggested']
                        ]
                    ],
                    'required' => ['analysis', 'rating', 'primaryCTAValue']
                ],
                'conflictingCTAs' => [
                    'type' => 'OBJECT',
                    'description' => 'Assessment of competing calls-to-action.',
                    'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Assessment of any competing or conflicting calls-to-action.'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Numerical rating reflecting the impact of conflicting CTAs (lower is better).'],
                         'conflictingCTAsValue' => [
                            'type' => 'OBJECT',
                            'properties' => [
                                'current' => ['type' => 'STRING', 'description' => 'Comma-separated list of conflicting CTA text, or "None".'],
                            ],
                            'required' => ['current']
                        ]
                    ],
                     'required' => ['analysis', 'rating', 'conflictingCTAsValue']
                ],
                'features' => [
                    'type' => 'OBJECT',
                    'description' => 'Identification of core product/service features.',
                    'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Identification of the core product/service features discussed.'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Numerical rating of feature presentation clarity.'],
                    ],
                    'required' => ['analysis', 'rating']
                ],
                'benefits' => [
                    'type' => 'OBJECT',
                    'description' => 'Analysis of how well features connect to customer benefits.',
                     'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Analysis of how well the site connects features to customer benefits.'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Numerical rating of benefit communication effectiveness.'],
                    ],
                    'required' => ['analysis', 'rating']
                ],
                'benefitPresentation' => [
                    'type' => 'OBJECT',
                    'description' => 'Evaluation of how benefits are presented and emphasized.',
                     'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Evaluation of how benefits are presented and emphasized.'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Numerical rating of benefit presentation quality.'],
                    ],
                    'required' => ['analysis', 'rating']
                ],
                'socialProof' => [
                    'type' => 'OBJECT',
                    'description' => 'Assessment of testimonials, case studies, or other social proof.',
                    'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Assessment of testimonials, case studies, logos, etc. Note presence/absence and type.'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Numerical rating of social proof effectiveness/presence.'],
                    ],
                    'required' => ['analysis', 'rating']
                ],
                 'associatedBrands' => [
                    'type' => 'OBJECT',
                    'description' => 'Assessment of associated brand logos and their placement.',
                    'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Assessment of any associated brand images (e.g., client logos) and their placement on the page.'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Numerical rating of associated brands presentation effectiveness.'],
                    ],
                    'required' => ['analysis', 'rating']
                ],
                'overall' => [
                    'type' => 'OBJECT',
                    'description' => 'Overall assessment of the website\'s effectiveness.',
                    'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Overall thoughts on what this website is trying to achieve and how well it does so.'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Overall numerical rating of the landing page effectiveness.'],
                    ],
                    'required' => ['analysis', 'rating']
                ],
                'conversionChance' => [
                    'type' => 'OBJECT',
                    'description' => 'Likelihood of a visitor converting.',
                     'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'Overall thoughts on the likelihood of a site visitor converting.'],
                         'responseOptions' => ['type' => 'STRING', 'description' => 'Should be one of: `Very likely`, `Likely`, `Somewhat likely`, `Unlikely`, or `Very unlikely`.'],
                        'rating' => ['type' => 'NUMBER', 'description' => 'Numerical rating reflecting conversion likelihood.'], // Rating might be redundant if responseOptions is primary
                    ],
                     'required' => ['analysis', 'responseOptions', 'rating']
                ],
                 'mainImprovement' => [
                    'type' => 'OBJECT',
                    'description' => 'The single most important improvement suggestion.',
                    'properties' => [
                        'analysis' => ['type' => 'STRING', 'description' => 'List briefly the ONE thing that this website should focus on to improve the likelihood of a customer signup.'],
                    ],
                     'required' => ['analysis']
                ],
            ],
             'required' => [ // List all top-level keys you absolutely need
                 'messaging', 'valueProposition', 'headline', 'primaryCTA', 'conflictingCTAs',
                 'features', 'benefits', 'benefitPresentation', 'socialProof', 'associatedBrands',
                 'overall', 'conversionChance', 'mainImprovement'
            ]
        ];

        try {
            // Step 1: Create a temporary file
            $tempPath = 'temp/' . uniqid() . '_' . $filename;
            Storage::put($tempPath, $html);
            $fullPath = Storage::path($tempPath);

            // Step 2: Encode temporary file
            $fileContent = file_get_contents($fullPath);
            $base64Content = base64_encode($fileContent);

            // Models
            // Flash: gemini-2.0-flash
            // 2.5E: gemini-2.5-pro-exp-03-25

            // Step 3: Send to Gemini for processing
            $response = $this->createRequest()
                ->timeout(180)
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                ['inline_data' => [
                                        'mime_type' => 'text/html',
                                        "data" => $base64Content
                                    ]
                                ],
                                ['text' => $message]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'response_mime_type' => 'application/json',
                        'response_schema' => $responseSchema
                    ]
                ]);

            // Step 4: Get the JSON response
            $apiResponseData = $response->json();

            Log::info('Full API Response: ' . print_r($apiResponseData, true));

            // Step 5: Log usage data
            if ($apiResponseData['usageMetadata']) {
                $usageData = $apiResponseData['usageMetadata'];

                if (isset($usageData['promptTokenCount']) &&
                    isset($usageData['candidatesTokenCount']) &&
                    isset($usageData['thoughtsTokenCount'])) {
                        $today = now()->toDateString();
                        $usage = ApiUsage::firstOrNew(['usage_date' => $today]);

                        $usage->input_tokens = ($usage->input_tokens ?? 0) + $usageData['promptTokenCount'];
                        $usage->output_tokens = ($usage->output_tokens ?? 0) + $usageData['candidatesTokenCount'];
                        $usage->thought_tokens = ($usage->thought_tokens ?? 0) + $usageData['thoughtsTokenCount'];
                        $usage->prompt_count = ($usage->prompt_count ?? 0) + 1; // Increment prompt counter

                        $usage->save();
                    }
            }

            // Log::info('Full Gemini Response: ' . print_r($apiResponseData, true));
            
            // Step 6: Evaluate the JSON response
            if (isset($apiResponseData['candidates'][0]['content']['parts'][0]['text'])) {
                // The value here IS your decoded JSON object (as a PHP array)
               $analysisResult = $apiResponseData['candidates'][0]['content']['parts'][0]['text'];

                // Now you can access its properties directly:
                // $messagingAnalysis = $analysisResult['messaging']['analysis'] ?? null;
                // $headlineRating = $analysisResult['headline']['rating'] ?? null;
                // etc.
   
                // Return only your structured result
               return $analysisResult;
   
           } else {
                // Handle cases where the expected structure isn't returned
                \Log::error('Gemini API response format unexpected: ' . $response->body());
                return response()->json([
                   'error' => 'Failed to extract structured data from Gemini response.',
                   'api_response' => $apiResponseData // Return the full response for debugging
                   ], 500);
           }
        } catch (Exception $e) {
            Log::error('OpenAI API error while uploading file: ' . $e->getMessage());
            throw new Exception('File upload failed: ' . $e->getMessage());
        } finally {
            // Clean up the temporary file
            if ($tempPath) {
                Storage::delete($tempPath);
            }
        }
    }

    /**
     * Create a configured HTTP request with proper headers for OpenAI API
     * 
     * @return PendingRequest
     */
    protected function createRequest() {
        // For file uploads, we should NOT set the Content-Type header
        $headers = [
            'Content-Type' => 'application/json'
        ];

        $request = Http::withHeaders($headers);
        
        // Add retry functionality with exponential backoff
        return $request->retry($this->maxRetries, function ($attempt, Exception $exception) {
            // Calculate delay with exponential backoff (100ms, 200ms, 400ms, 800ms...)
            $delay = min($this->maxRetryDelay, $this->retryDelay * (2 ** ($attempt - 1)));
            
            // Add jitter (±20%)
            $jitter = $delay * (mt_rand(80, 120) / 100);
            
            // Log retry attempt
            $errorMessage = $exception instanceof RequestException 
                ? "HTTP {$exception->response->status()}: {$exception->response->body()}" 
                : $exception->getMessage();
                
            Log::warning("Retrying Gemini API request (attempt {$attempt}/{$this->maxRetries}) after " . ($jitter/1000) . "s delay. Previous error: {$errorMessage}");
            
            return $jitter; // Return delay in milliseconds
        }, function (Exception $exception, PendingRequest $request) {
            // Only retry on server errors (5xx), rate limits (429), and connection issues
            if ($exception instanceof ConnectionException) {
                return true;
            }
            
            if ($exception instanceof RequestException) {
                $status = $exception->response->status();
                return $status >= 500 || $status === 429;
            }
            
            return false;
        });
    }
}