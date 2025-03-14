<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

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
        $this->info('Scanning ' . $url . ' now...');
    }
}
