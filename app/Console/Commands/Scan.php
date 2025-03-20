<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

use App\Models\QuickScan as QuickScanModel;
use App\Jobs\QuickScan\QuickScan;
use Illuminate\Support\Facades\Log;

class Scan extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scan
                                {url : The website URL to scan} 
                                {id? : (optional) The ID of the scan to use}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scans a website for CRO optimization opportunities';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        $url = $this->argument('url');
        
        // If ID is provided, find the existing QuickScan
        if ($id) {
            $quickScan = QuickScanModel::find($id);
            
            if (!$quickScan) {
                $this->error('No QuickScan found with ID: ' . $id);
                return 1;
            }
            
            // Reset the existing scan's status
            $quickScan->update([
                'status' => 'queued',
                'progress' => 0
            ]);
            
            $this->info('✅ Existing scan for ' . $quickScan->url . ' reset and queued.');
        } 
        // Otherwise, always create a new one
        else {
            if (!$url) {
                $this->error('URL is required when no ID is provided.');
                return 1;
            }
            
            $quickScan = QuickScanModel::create([
                'url' => $url,
                'name' => 'Marc McDougall',
                'email' => 'marc@marcmcdougall.com',
                'status' => 'queued',
                'progress' => 0
            ]);
            
            $this->info('✅ New scan created for ' . $url . ' and queued.');
            $fullUrl = config('app.url') . route('quick-scan.show', $quickScan->id, false);
            $this->line('🌐 Report URL: ' . $fullUrl);
        }

        // Dispatch the job
        QuickScan::dispatch($quickScan);
    }
}
