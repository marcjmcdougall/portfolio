<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
    protected $useAssistantApi = false;
    
    public function __construct($useAssistantApi = false) {
        $this->useAssistantApi = $useAssistantApi;
    }
    
    /**
     * Create a new thread for the assistant
     * 
     * @return string Thread ID
     */
    public function createThread() {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.api_key'),
            'Content-Type' => 'application/json',
            'OpenAI-Beta' => 'assistants=v2',
        ])->post('https://api.openai.com/v1/threads');
        
        if (!$response->successful()) {
            Log::error('OpenAI API error while creating thread: ' . $response->status() . ' - ' . $response->body());
            throw new \Exception('Failed to create thread: ' . $response->status());
        }
        
        $this->threadId = $response->json()['id'];
        Log::info('Created new thread: ' . $this->threadId);
        
        return $this->threadId;
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
        // Step 1: Create a temporary file
        $tempPath = 'temp/' . uniqid() . '_' . $filename;
        Storage::put($tempPath, $html);
        $fullPath = Storage::path($tempPath);
        
        // Step 2: Upload the file to OpenAI
        $fileUploadResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.api_key'),
        ])->attach(
            'file', fopen($fullPath, 'r'), $filename, ['Content-Type' => 'text/html']
        )->post('https://api.openai.com/v1/files', [
            'purpose' => 'assistants',
        ]);
        
        // Clean up the temporary file
        Storage::delete($tempPath);
        
        if (!$fileUploadResponse->successful()) {
            Log::error('OpenAI API error while uploading file: ' . $fileUploadResponse->status() . ' - ' . $fileUploadResponse->body());
            throw new \Exception('Failed to upload file: ' . $fileUploadResponse->status());
        }
        
        $fileId = $fileUploadResponse->json()['id'];
        Log::info('File uploaded with ID: ' . $fileId);
        
        // Step 3: Create a thread with the initial message and file attachment
        $threadResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.api_key'),
            'Content-Type' => 'application/json',
            'OpenAI-Beta' => 'assistants=v2',
        ])->post('https://api.openai.com/v1/threads', [
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'This is the HTML file we will be evaluating today.',
                    'attachments' => [
                        [
                            'file_id' => $fileId,
                            'tools' => [['type' => 'file_search']]
                        ]
                    ]
                ]
            ]
        ]);
        
        if (!$threadResponse->successful()) {
            Log::error('OpenAI API error while creating thread: ' . $threadResponse->status() . ' - ' . $threadResponse->body());
            throw new \Exception('Failed to create thread: ' . $threadResponse->status());
        }
        
        $this->threadId = $threadResponse->json()['id'];
        Log::info('Created thread with file attachment: ' . $this->threadId);
        
        return $this->threadId;
    }
    
    /**
     * Upload HTML content directly to the current thread (Deprecated)
     * 
     * @param string $html HTML content
     * @param string $filename Filename for the upload
     * @return string Message ID of the upload message
     */
    // public function uploadHtmlToThread($html, $filename = 'page.html') {
    //     if (!$this->threadId) {
    //         throw new \Exception('No thread created. Call createThread() first.');
    //     }
        
    //     // First, create a temporary file
    //     $tempPath = sys_get_temp_dir() . '/' . $filename;
    //     file_put_contents($tempPath, $html);
        
    //     // Create a multipart form request to upload the file directly to the thread
    //     $response = Http::withHeaders([
    //         'Authorization' => 'Bearer ' . config('services.openai.api_key'),
    //         'OpenAI-Beta' => 'assistants=v2',
    //     ])->attach(
    //         'file', file_get_contents($tempPath), $filename, ['Content-Type' => 'text/html']
    //     )->post("https://api.openai.com/v1/threads/{$this->threadId}/messages", [
    //         'role' => 'user',
    //         'content' => 'I am uploading an HTML file for you to analyze. Please confirm you have access to it.',
    //     ]);
        
    //     // Clean up the temporary file
    //     unlink($tempPath);
        
    //     if (!$response->successful()) {
    //         Log::error('OpenAI API error while uploading file to thread: ' . $response->status() . ' - ' . $response->body());
    //         throw new \Exception('Failed to upload file to thread: ' . $response->status());
    //     }
        
    //     $messageId = $response->json()['id'];
    //     Log::info('File uploaded directly to thread, message ID: ' . $messageId);
        
    //     // Run the assistant to confirm file access
    //     $this->runAssistant();
        
    //     return $messageId;
    // }
    
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

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.api_key'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'o3-mini', // Use the appropriate model
            'messages' => $this->messages,
            'max_completion_tokens' => 1500,
        ]);

        // Check if the request was successful
        if ($response->successful()) {
            // Get the response body
            $responseData = $response->json();
            $assistantResponse = $responseData['choices'][0]['message']['content'];

            // Append the reply history
            $this->appendMessage('assistant', $assistantResponse);

            Log::info('OpenAI response: ' . $assistantResponse);

            return $assistantResponse;
        } else {
            // Handle error
            Log::error('OpenAI API error: ' . $response->status() . ' - ' . $response->body());
            throw new \Exception('Failed to get completion: ' . $response->status());
        }
    }
    
    /**
     * New method using Assistants API
     * 
     * @param string $message The user's message
     * @return string Response from the Assistant
     */
    protected function askAssistant($message) {
        if (!$this->threadId) {
            throw new \Exception('No thread created. Call createThread() first.');
        }
        
        // Add the message to the thread
        $messageResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.api_key'),
            'Content-Type' => 'application/json',
            'OpenAI-Beta' => 'assistants=v2',
        ])->post("https://api.openai.com/v1/threads/{$this->threadId}/messages", [
            'role' => 'user',
            'content' => $message,
        ]);
        
        if (!$messageResponse->successful()) {
            Log::error('OpenAI API error while adding message: ' . $messageResponse->status() . ' - ' . $messageResponse->body());
            throw new \Exception('Failed to add message: ' . $messageResponse->status());
        }
        
        // Run the assistant on the thread
        return $this->runAssistant();
    }
    
    /**
     * Run the assistant on the current thread
     * 
     * @return string|null Assistant's response (or null if async)
     */
    protected function runAssistant() {
        // Start a run
        $runResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.api_key'),
            'Content-Type' => 'application/json',
            'OpenAI-Beta' => 'assistants=v2',
        ])->post("https://api.openai.com/v1/threads/{$this->threadId}/runs", [
            'assistant_id' => $this->assistantId,
        ]);
        
        if (!$runResponse->successful()) {
            Log::error('OpenAI API error while starting run: ' . $runResponse->status() . ' - ' . $runResponse->body());
            throw new \Exception('Failed to start run: ' . $runResponse->status());
        }
        
        $runId = $runResponse->json()['id'];
        
        // Poll for the completion of the run.
        $completed = false;
        $maxAttempts = 30; // Reduced from 60
        $attempts = 0;
        $baseDelay = 2; // Start with 2 seconds
        
        while (!$completed && $attempts < $maxAttempts) {
            $attempts++;
            
            // Exponential backoff with a cap
            $delay = min(30, $baseDelay * (2 ** ($attempts - 1)));
            sleep($delay);
            
            $statusResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openai.api_key'),
                'OpenAI-Beta' => 'assistants=v2',
            ])->get("https://api.openai.com/v1/threads/{$this->threadId}/runs/{$runId}");
            
            if (!$statusResponse->successful()) {
                Log::error('OpenAI API error while checking run status: ' . $statusResponse->status() . ' - ' . $statusResponse->body());
                throw new \Exception('Failed to check run status: ' . $statusResponse->status());
            }
            
            $status = $statusResponse->json()['status'];
            
            if ($status === 'completed') {
                $completed = true;
            } elseif (in_array($status, ['failed', 'cancelled', 'expired'])) {
                Log::error('OpenAI Assistant run failed with status: ' . $status);
                Log::error('Full response: ' . print_r($statusResponse->json(), true));
                throw new \Exception('Assistant run failed with status: ' . $status);
            }
            
            Log::info("Run status: {$status}, attempt {$attempts}");
        }
        
        if (!$completed) {
            throw new \Exception('Assistant run timed out after ' . $maxAttempts . ' attempts');
        }
        
        return $this->getLatestAssistantMessage($runId);
    }
    
    /**
     * Get the most recent assistant message from a thread
     * 
     * @param string $runId Optional run ID for logging
     * @return mixed|string The message content (parsed JSON if applicable)
     */
    protected function getLatestAssistantMessage($runId = null) {
        // Get the messages (most recent first)
        $messagesResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.api_key'),
            'OpenAI-Beta' => 'assistants=v2',
        ])->get("https://api.openai.com/v1/threads/{$this->threadId}/messages", [
            'order' => 'desc',
            'limit' => 1,
        ]);
        
        if (!$messagesResponse->successful()) {
            Log::error('OpenAI API error while getting messages: ' . $messagesResponse->status() . ' - ' . $messagesResponse->body());
            throw new \Exception('Failed to get messages: ' . $messagesResponse->status());
        }
        
        $messages = $messagesResponse->json()['data'];
        
        // Get the first (most recent) message from the assistant
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
                
                // If the assistant is configured for JSON responses, parse the JSON
                if (strpos($content, '{') === 0) {
                    try {
                        // Return either the decoded JSON object or the raw string
                        // depending on your needs (change the second parameter to true
                        // if you want an associative array instead of an object)
                        $jsonContent = json_decode($content, true);
                        
                        // Check if JSON was valid
                        if (json_last_error() === JSON_ERROR_NONE) {
                            Log::info('Successfully parsed JSON response');
                            return $jsonContent;
                        } else {
                            Log::warning('Response appears to be JSON but failed to parse: ' . json_last_error_msg());
                        }
                    } catch (\Exception $e) {
                        Log::warning('Exception while parsing JSON response: ' . $e->getMessage());
                    }
                }
                
                // Return the original content if it wasn't valid JSON or parsing failed
                return $content;
            }
        }
        
        throw new \Exception('No assistant message found after run completion');
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