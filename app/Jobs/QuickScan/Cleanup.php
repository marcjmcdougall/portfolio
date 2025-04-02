<?php

namespace App\Jobs\QuickScan;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


use App\Models\QuickScan;

class Cleanup implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
        $this->onQueue('important');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Get QuickScans older than 30 days
        $date = now()->subDays(30);
        
        // Log start of job
        Log::info('Starting cleanup of QuickScans older than 30 days...');
        
        // Count total records to be processed
        $totalCount = QuickScan::where('created_at', '<', $date)->count();
        Log::info("Found {$totalCount} QuickScans to delete");
        
        // Initialize counter for deleted records
        $deletedCount = 0;
        
        // Retrieve scans to delete in chunks to prevent memory issues
        QuickScan::where('created_at', '<', $date)
            ->chunkById(100, function ($scans) use (&$deletedCount) {
                foreach ($scans as $scan) {
                    if ($this->deleteQuickScan($scan)) {
                        $deletedCount++;
                    }
                }
                
                // Log progress after each chunk
                Log::info("Processed chunk, deleted {$deletedCount} QuickScans so far");
            });
            
        Log::info("Cleanup job completed: {$deletedCount} QuickScans older than 30 days have been deleted.");
    }

    /**
     * Delete a QuickScan and its associated screenshot.
     *
     * @param QuickScan $scan
     * @return bool Whether the deletion was successful
     */
    private function deleteQuickScan(QuickScan $scan)
    {
        try {
            // Delete the screenshot if it exists and is in a success state
            if ($scan->screenshot_path && $scan->screenshot_path->isSuccess()) {
                $screenshotPath = $scan->screenshot_path->getValue();
                
                if ($screenshotPath && Storage::exists($screenshotPath)) {
                    Storage::delete($screenshotPath);
                    Log::info("Deleted screenshot: {$screenshotPath}");
                }
            }
            
            // Delete the QuickScan record
            $scan->delete();
            Log::info("Deleted QuickScan ID: {$scan->id} for domain: {$scan->domain}");
            
            return true;
            
        } catch (\Exception $e) {
            Log::error("Error deleting QuickScan ID: {$scan->id}", [
                'exception' => $e->getMessage(),
                'domain' => $scan->domain
            ]);
            
            return false;
        }
    }
}
