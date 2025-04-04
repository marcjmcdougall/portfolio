<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Models\QuickScan;
use App\Jobs\QuickScan\Cleanup;

class QuickScanCleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:quick-scan-cleanup {id? : The ID of a specific QuickScan to delete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete QuickScans older than 30 days or a specific QuickScan by ID';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Check if a specific ID was provided
        $id = $this->argument('id');
        
        if ($id) {
            $this->info("Attempting to delete QuickScan with ID: {$id}");
            
            // Find the QuickScan
            $quickScan = QuickScan::find($id);
            
            if (!$quickScan) {
                $this->error("QuickScan with ID {$id} not found.");
                return 1;
            }
            
            // Confirm deletion
            if (!$this->confirm("Are you sure you want to delete QuickScan for '{$quickScan->domain}'?")) {
                $this->info('Operation cancelled.');
                return 0;
            }
            
            // Delete the screenshot if it exists
            if ($quickScan->screenshot_path && $quickScan->screenshot_path->isSuccess()) {
                $relativePath = $quickScan->screenshot_path->getValue();
                // $screenshotPath =  storage_path('app/public/' . $relativePath);
                
                if ($relativePath && Storage::disk('public')->exists($relativePath)) {
                    Storage::disk('public')->delete($relativePath);
                    Log::info("Deleted screenshot: {$relativePath}");
                } else {
                    Log::info("Screenshot not found: {$relativePath}");
                }
            }
            
            // Delete the QuickScan
            $quickScan->delete();
            $this->info("QuickScan with ID {$id} has been deleted.");
            
            return 0;
        }

        $this->info('Starting cleanup of old QuickScans...');
        
        // Dispatch the job immediately
        Cleanup::dispatch();
        
        $this->info('Cleanup job dispatched successfully.');
        
        return 0;
    }
}
