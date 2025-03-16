<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Http;

/**
 * OpenAIController - A helper class for interacting with OpenAI's chat completion API
 * 
 * This class facilitates conversations with OpenAI's language models, specifically
 * configured for conversion rate optimization analysis. It maintains conversation
 * history across multiple exchanges and provides methods to:
 * 
 * - Send messages to OpenAI and receive responses
 * - Append new messages to the conversation history
 * - Retrieve the full message history
 * 
 * The class initializes with a system message that instructs the AI to act as a 
 * conversion rate optimization expert focused on evaluating text clarity and its 
 * potential to advance users through marketing funnels.
 * 
 * Usage example:
 * ```
 * $ai = new OpenAIController();
 * $response = $ai->askOpenAI("Please evaluate this landing page copy: ...");
 * $history = $ai->getMessageHistory();
 * ```
 * 
 * @package App\Helpers
 */
class OpenAIController
{
    protected $messages = [
        [   
            'role' => 'system',
            'content' => 'You are a conversion-rate optimization expert, and your goal is to evaluate any text sent to you for clarity, and judge whether or not it is likely to influence a user to move to the next step in a given marketing funnel.'
        ],
    ]; 
    public function __construct() {

    }

    function ask($message) {
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
        }
    }

    function appendMessage($role, $message){
        $this->messages[] = [
            'role' => $role,
            'content' => $message,
        ];
    }

    function getMessageHistory(){
        return $this->messages;
    }
}