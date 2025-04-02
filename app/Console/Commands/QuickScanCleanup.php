<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\QuickScan\Cleanup;


class QuickScanCleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:quick-scan-cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete QuickScans older than 30 days and their screenshots';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting cleanup of old QuickScans...');
        
        // Dispatch the job immediately
        Cleanup::dispatch();
        
        $this->info('Cleanup job dispatched successfully.');
        
        return 0;
    }
}
