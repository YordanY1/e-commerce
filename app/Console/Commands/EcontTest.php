<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\EcontService;

class EcontTest extends Command
{
    protected $signature = 'econt:test';
    protected $description = 'Test Econt API';

    public function handle()
    {
        $econtService = app(EcontService::class);
        try {
            $offices = $econtService->getOffices();
            $this->info('Offices fetched successfully.');
            print_r($offices);
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }

}
