<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;


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
class OpenAIController
{
    protected $messages = [
        [   
            'role' => 'system',
            'content' => 'You are a 180IQ conversion-rate optimization expert, 
                and your goal is to evaluate any text sent to you for clarity, 
                and judge whether or not it is likely to influence a user to move 
                to the next step in a given marketing funnel.  You are to respond
                using brevity at all times, and rarely should your responses exceed
                50 total words.'
        ],
    ];
    
    // Assistant API properties
    // Ref: https://platform.openai.com/assistants/asst_zbSbOx03TWEgGM5pSoVQ4EVj
    protected $assistantId = 'asst_zbSbOx03TWEgGM5pSoVQ4EVj';
    protected $threadId = null;
    protected $fileId = null;
    protected $useAssistantApi = false;

    // Retry settings
    protected $maxRetries = 4;
    protected $retryDelay = 100; // Base delay in milliseconds
    protected $maxRetryDelay = 30000; // Max delay in milliseconds (30 seconds)
    
    public function __construct($useAssistantApi = false) {
        $this->useAssistantApi = $useAssistantApi;
    }
    
    /**
     * Create a new thread for the assistant
     * 
     * @return string Thread ID
     */
    public function createThread() {
        $response = $this->createRequest()
            ->post('https://api.openai.com/v1/threads');
        
        $this->threadId = $response->json()['id'];
        Log::info('Created new thread: ' . $this->threadId);
        
        return $this->threadId;
        // $response = Http::withHeaders([
        //     'Authorization' => 'Bearer ' . config('services.openai.api_key'),
        //     'Content-Type' => 'application/json',
        //     'OpenAI-Beta' => 'assistants=v2',
        // ])->post('https://api.openai.com/v1/threads');
        
        // if (!$response->successful()) {
        //     Log::error('OpenAI API error while creating thread: ' . $response->status() . ' - ' . $response->body());
        //     throw new \Exception('Failed to create thread: ' . $response->status());
        // }
        
        // $this->threadId = $response->json()['id'];
        // Log::info('Created new thread: ' . $this->threadId);
        
        // return $this->threadId;
    }

    /**
     * Create a new thread with an HTML file attached to the first message
     * 
     * @param string $html HTML content
     * @param string $filename Filename for the upload
     * @param string $message Initial message text
     * @return string Thread ID
     */
    public function createThreadWithFile($html, $filename = 'page.html') {
        // File operations
        $tempPath = null;
        
        try {
            // Step 1: Create a temporary file
            $tempPath = 'temp/' . uniqid() . '_' . $filename;
            Storage::put($tempPath, $html);
            $fullPath = Storage::path($tempPath);
            
            // Step 2: Upload the file to OpenAI
            $fileUploadResponse = $this->createRequest(true)
                ->attach(
                    'file', 
                    fopen($fullPath, 'r'), 
                    $filename, 
                    ['Content-Type' => 'text/html']
                )
                ->post('https://api.openai.com/v1/files', [
                    'purpose' => 'assistants',
                ]);

            $this->fileId = $fileUploadResponse->json()['id'];
            Log::info('File uploaded with ID: ' . $this->fileId);
        } catch (Exception $e) {
            Log::error('OpenAI API error while uploading file: ' . $e->getMessage());
            throw new Exception('File upload failed: ' . $e->getMessage());
        } finally {
            // Clean up the temporary file
            if ($tempPath) {
                Storage::delete($tempPath);
            }
        }
        
        // Thread operations
        try {
            // Step 3: Create a thread with the initial message and file attachment
            $threadResponse = $this->createRequest()
                ->post('https://api.openai.com/v1/threads', [
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => 'This is the HTML file we will be evaluating today.',
                            'attachments' => [
                                [
                                    'file_id' => $this->fileId,
                                    'tools' => [
                                        ['type' => 'file_search'],
                                        // ['type' => 'code_interpreter']
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]);
            
            $this->threadId = $threadResponse->json()['id'];
            Log::info('Created thread with file attachment: ' . $this->threadId);
            
            return $this->threadId;
        } catch (Exception $e) {
            Log::error('OpenAI API error while creating thread: ' . $e->getMessage());
            throw new Exception('OpenAI API error while creating thread: ' . $e->getMessage());
        }
        // // File operations
        // try {
        //     // Step 1: Create a temporary file
        //     $tempPath = 'temp/' . uniqid() . '_' . $filename;
        //     Storage::put($tempPath, $html);
        //     $fullPath = Storage::path($tempPath);
            
        //     // Step 2: Upload the file to OpenAI
        //     $fileUploadResponse = Http::withHeaders([
        //         'Authorization' => 'Bearer ' . config('services.openai.api_key'),
        //     ])->attach(
        //         'file',
        //         fopen($fullPath, 'r'),
        //         $filename, ['Content-Type' => 'text/html']
        //     )->post('https://api.openai.com/v1/files', [
        //         'purpose' => 'assistants',
        //     ]);

        //     if ( ! $fileUploadResponse->successful() ) {
        //         Log::error('OpenAI API error while uploading file: ' . $fileUploadResponse->status() . ' - ' . $fileUploadResponse->body());
        //         throw new \Exception('Failed to upload file: ' . $fileUploadResponse->status());
        //     }

        //     $this->fileId = $fileUploadResponse->json()['id'];
        //     Log::info('File uploaded with ID: ' . $this->fileId);
        // } catch (\Exception $e) {
        //     Log::error('OpenAI API error while uploading file: ' . $e->getMessage());
        //     throw new \Exception('File upload failed: ' . $e->getMessage()); // Bubble up
        // } finally {
        //      // Clean up the temporary file
        //     Storage::delete($tempPath);
        // }
        
        // // Thread operations
        // try {
        //     // Step 3: Create a thread with the initial message and file attachment
        //     $threadResponse = Http::withHeaders([
        //         'Authorization' => 'Bearer ' . config('services.openai.api_key'),
        //         'Content-Type' => 'application/json',
        //         'OpenAI-Beta' => 'assistants=v2',
        //     ])->post('https://api.openai.com/v1/threads', [
        //         'messages' => [
        //             [
        //                 'role' => 'user',
        //                 'content' => 'This is the HTML file we will be evaluating today.',
        //                 'attachments' => [
        //                     [
        //                         'file_id' => $this->fileId,
        //                         'tools' => [['type' => 'file_search']]
        //                     ]
        //                 ]
        //             ]
        //         ]
        //     ]);
            
        //     if (!$threadResponse->successful()) {
        //         Log::error('OpenAI API error while creating thread: ' . $threadResponse->status() . ' - ' . $threadResponse->body());
        //         throw new \Exception('Failed to create thread: ' . $threadResponse->status());
        //     }
            
        //     $this->threadId = $threadResponse->json()['id'];
        //     Log::info('Created thread with file attachment: ' . $this->threadId);
            
        //     return $this->threadId;
        // }
        // catch (\Exception $e) {
        //     Log::error('OpenAI API error while creating thread: ' . $e->getMessage());
        //     throw new \Exception('OpenAI API error while creating thread: ' . $e->getMessage()); // Bubble up
        // }
    }
    
    /**
     * Ask a question to either the Chat Completions API or Assistants API
     * 
     * @param string $message The user's message
     * @return string Response from the AI
     */
    public function ask($message) {
        if ($this->useAssistantApi && $this->threadId) {
            return $this->askAssistant($message);
        } else {
            return $this->askChatCompletions($message);
        }
    }
    
    /**
     * Original method using Chat Completions API
     * 
     * @param string $message The user's message
     * @return string Response from the AI
     */
    protected function askChatCompletions($message) {
        // Append the message to the history
        $this->appendMessage('user', $message);

        $response = $this->createRequest()
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'o3-mini',
                'messages' => $this->messages,
                'max_completion_tokens' => 1500,
            ]);

        // Get the response body
        $responseData = $response->json();
        $assistantResponse = $responseData['choices'][0]['message']['content'];

        // Append the reply history
        $this->appendMessage('assistant', $assistantResponse);

        Log::info('OpenAI response: ' . $assistantResponse);

        return $assistantResponse;
    }
    
    /**
     * New method using Assistants API
     * 
     * @param string $message The user's message
     * @return string Response from the Assistant
     */
    protected function askAssistant($message) {
        if (!$this->threadId) {
            throw new Exception('No thread created. Call createThread() first.');
        }
        
        // File access retry loop
        $maxFileAccessRetries = 3;
        $fileAccessRetryAttempt = 0;
        
        while ($fileAccessRetryAttempt < $maxFileAccessRetries) {
            $fileAccessRetryAttempt++;
            
            // Only add delay for retries after the first attempt
            if ($fileAccessRetryAttempt > 1) {
                $delay = min(30, 3 * (2 ** ($fileAccessRetryAttempt - 2)));
                $truncatedMessage = strlen($message) > 50 ? substr($message, 0, 50) . '...' : $message;
                Log::warning("Retrying entire assistant request for message '{$truncatedMessage}' (attempt {$fileAccessRetryAttempt}/{$maxFileAccessRetries}) after {$delay}s delay - assistant could not access the file");
                sleep($delay);
            }
            
            try {
                // Step 1: Add the message to the thread
                $this->createRequest()
                    ->post("https://api.openai.com/v1/threads/{$this->threadId}/messages", [
                        'role' => 'user',
                        'content' => $message,
                        'attachments' => $this->fileId ? [
                            [
                                'file_id' => $this->fileId,
                                'tools' => [['type' => 'file_search']]
                            ]
                        ] : []
                    ]);
                
                // Step 2: Run the assistant and wait for completion
                $this->runAssistant();
                
                // Step 3: Get the latest message and check for file access issues
                $response = $this->getLatestAssistantMessage();
                
                // Check if the response indicates file access issues
                if ( ! $this->hasFileAccessIssue($response) ) {
                    return $response; // Success!
                }
                
                // If we get here, there was a file access issue
                Log::warning("Assistant couldn't access the file. Response: " . substr(is_array($response) ? json_encode($response) : $response, 0, 200) . '...');
            } catch (Exception $e) {
                Log::error("Error in assistant request (attempt {$fileAccessRetryAttempt}): " . $e->getMessage());
                
                // If this is our last attempt, rethrow the exception
                if ($fileAccessRetryAttempt >= $maxFileAccessRetries) {
                    throw $e;
                }
            }
        }
        
        // If we've exhausted all retry attempts for file access issues
        throw new Exception("Assistant couldn't access the file after {$maxFileAccessRetries} attempts");
    }

    /**
     * Natural language check to determine if a response indicates that the 
     * assistant can't access the file.
     * 
     * @param string|array $response Response to check
     * @return bool True if the response indicates a file access issue
     */
    protected function hasFileAccessIssue($response) {
        $fileAccessIssuePatterns = [
            '/cannot\s+access\s+(?:the\s+)?file/i',
            '/don\'t\s+(?:have\s+)?access\s+to\s+(?:the\s+)?file/i',
            '/unable\s+to\s+access\s+(?:the\s+)?file/i',
            '/file\s+(?:is\s+)?(?:not\s+available|unavailable)/i',
            '/could\s+not\s+(?:find|locate|access|read)\s+(?:the\s+)?(?:uploaded\s+)?file/i',
            '/i\s+(?:can\'t|cannot)\s+(?:see|view|read|find)\s+(?:the\s+)?(?:content|file)/i'
        ];
        
        // If response is an array (JSON), convert to string
        $responseText = is_array($response) ? json_encode($response) : (string)$response;
        
        // Check if any pattern matches
        foreach ($fileAccessIssuePatterns as $pattern) {
            if (preg_match($pattern, $responseText)) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Run the assistant on the current thread
     * 
     * @return string|null Assistant's response (or null if async)
     */
    protected function runAssistant() {
        // Start a run
        $runResponse = $this->createRequest()
            ->post("https://api.openai.com/v1/threads/{$this->threadId}/runs", [
                'assistant_id' => $this->assistantId,
            ]);
        
        $runId = $runResponse->json()['id'];
        
        // Poll for the completion of the run
        $maxAttempts = 30;
        $attempts = 0;
        $baseDelay = 2;
        $maxDelay = 30;
        $status = null;
        
        while ($attempts < $maxAttempts) {
            $attempts++;
            
            // Calculate delay with exponential backoff
            $delay = min($maxDelay, $baseDelay * (2 ** ($attempts - 1)));
            $jitter = $delay * (mt_rand(80, 120) / 100);
            sleep($jitter);
            
            try {
                $statusResponse = $this->createRequest()
                    ->get("https://api.openai.com/v1/threads/{$this->threadId}/runs/{$runId}");
                
                $status = $statusResponse->json()['status'];
                Log::info("Run status: {$status}, attempt {$attempts}");
                
                if ($status === 'completed') {
                    return; // Run completed successfully
                } else if (in_array($status, ['failed', 'cancelled', 'expired'])) {
                    throw new Exception("Assistant run failed with status: {$status}");
                }
            } catch (Exception $e) {
                Log::error("Error checking run status (attempt {$attempts}): " . $e->getMessage());
                // Continue polling despite errors
            }
        }
        
        throw new Exception("Assistant run timed out after {$maxAttempts} polling attempts with status: " . ($status ?? 'unknown'));
    }
    
    /**
     * Get the most recent assistant message from a thread
     * 
     * @param string $runId Optional run ID for logging
     * @return mixed|string The message content (parsed JSON if applicable)
     */
    protected function getLatestAssistantMessage($runId = null) {
        $messagesResponse = $this->createRequest()
        ->get("https://api.openai.com/v1/threads/{$this->threadId}/messages", [
            'order' => 'desc',
            'limit' => 1,
        ]);
    
        $messages = $messagesResponse->json()['data'];
        
        // Find the assistant message
        foreach ($messages as $message) {
            if ($message['role'] === 'assistant') {
                $content = '';
                foreach ($message['content'] as $contentPart) {
                    if ($contentPart['type'] === 'text') {
                        $content = $contentPart['text']['value'];
                        break;
                    }
                }

                // Remove Markdown code block if present
                if (preg_match('/```(?:json)?\s*([\s\S]*?)\s*```/m', $content, $matches)) {
                    $content = $matches[1];
                    Log::info('Extracted JSON from code block');
                }
                
                // Parse JSON if applicable
                if (strpos($content, '{') === 0) {
                    try {
                        $sanitizedContent = $this->fixJsonTrailingCommas($content);
                        $jsonContent = json_decode($sanitizedContent, true);
                        
                        if (json_last_error() === JSON_ERROR_NONE) {
                            Log::info('Successfully parsed JSON response');
                            return $jsonContent;
                        } else {
                            Log::warning('Response appears to be JSON but failed to parse: ' . json_last_error_msg());
                        }
                    } catch (Exception $e) {
                        Log::warning('Exception while parsing JSON response: ' . $e->getMessage());
                    }
                }
                
                return $content;
            }
        }

        throw new Exception('No assistant message found after run completion');
    }

    /**
     * Create a configured HTTP request with proper headers for OpenAI API
     * 
     * @param bool $isAssistantApi Whether to add Assistant API headers
     * @return PendingRequest
     */
    protected function createRequest($isFileUpload = false) {
        // For file uploads, we should NOT set the Content-Type header
        // as Http::attach() will automatically set it to multipart/form-data
        $headers = [
            'Authorization' => 'Bearer ' . config('services.openai.api_key'),
        ];
        
        // Only add Content-Type for non-file upload requests
        if (!$isFileUpload) {
            $headers['Content-Type'] = 'application/json';
        }

        $request = Http::withHeaders($headers);
        
        if ($this->useAssistantApi) {
            $request = $request->withHeaders([
                'OpenAI-Beta' => 'assistants=v2',
            ]);
        }
        
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
                
            Log::warning("Retrying OpenAI request (attempt {$attempt}/{$this->maxRetries}) after " . ($jitter/1000) . "s delay. Previous error: {$errorMessage}");
            
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

    /**
     * Removes trailing commas from JSON objects.
     * 
     * @param mixed $json
     * @return array|string|null
     */
    function fixJsonTrailingCommas($json)
    {
        // Replace comma followed by closing brace
        $json = preg_replace('/,\s*}/', '}', $json);
        
        // Replace comma followed by closing bracket
        $json = preg_replace('/,\s*]/', ']', $json);
        
        return $json;
    }

    /**
     * Append a message to the history (for Chat Completions API)
     * 
     * @param string $role Role of the message (user or assistant)
     * @param string $message Content of the message
     */
    function appendMessage($role, $message){
        $this->messages[] = [
            'role' => $role,
            'content' => $message,
        ];
    }

    /**
     * Get the full message history (for Chat Completions API)
     * 
     * @return array Array of message objects
     */
    function getMessageHistory(){
        return $this->messages;
    }
    
    /**
     * Get the current thread ID
     * 
     * @return string|null Thread ID
     */
    function getThreadId() {
        return $this->threadId;
    }
    
    /**
     * Set an existing thread ID (instead of creating a new one)
     * 
     * @param string $threadId Thread ID to use
     */
    function setThreadId($threadId) {
        $this->threadId = $threadId;
    }
    
    /**
     * Set which API to use (true for Assistants API, false for Chat Completions)
     * 
     * @param bool $useAssistantApi Whether to use the Assistants API
     */
    function setUseAssistantApi($useAssistantApi) {
        $this->useAssistantApi = $useAssistantApi;
    }
}