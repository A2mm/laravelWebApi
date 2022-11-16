<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Should Install Project Dependencies';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       // exec('composer install');

        Artisan::call('migrate');
        Artisan::call('db:seed');

        return 'project installed successfully';
    }
}
