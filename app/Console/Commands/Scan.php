<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

use App\Models\QuickScan as QuickScanModel;
use App\Jobs\QuickScan\QuickScan;

class Scan extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scan
                                {url : The website URL to scan}';

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
        $url = $this->argument('url');

        $quickScan = QuickScanModel::create([
            'url' => $url,
            'name' => 'Marc McDougall',
            'email' => 'marc@marcmcdougall.com',
            'status' => 'queued',
            'progress' => 0
        ]);

        $this->info('Scanning ' . $url . ' now...');

        // Dispatch the job synchronously (pass command to return status updates).
        QuickScan::dispatchSync($quickScan);

        $this->info('✅ Scan completed!');
    }
}
