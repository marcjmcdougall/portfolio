<?php

namespace App\Console\Commands;

use App\Helpers\ApiResult;
use App\Helpers\GeminiController;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

use App\Models\QuickScan;

class AskGemini extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ask-gemini
                                {message : The message to ask}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Asks Gemini a question';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $message = $this->argument('message');
        
        // If ID is provided, find the existing QuickScan
        $gemini = new GeminiController();

        // Create the QuickScan
        $quickScan = new QuickScan();
        $quickScan->url = 'https://wp-bullet.com';
        $quickScan->email = 'marc@marcmcdougall.com';
        $quickScan->save();

        $fullUrl = config('app.url') . route('quick-scan.show', [
            'quickScan' => $quickScan->id,
            'domain' => $quickScan->domain,
        ], false);

        $this->line('QuickScan will be found at...' . $fullUrl);
        $this->line('Asking Gemini now...');

        $response = $gemini->ask($message);
        $this->line('🌐 Response received');

        \Log::info(print_r($response, true));

        $quickScan->update([
            'openai_messaging_audit' => ApiResult::success($response),
        ]);

        // Add progress regardless of outcome
        $quickScan->addProgress(50);
    }
}
