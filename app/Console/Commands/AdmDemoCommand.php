<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AdmDemoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adm:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adding demo data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('migrate');
        $this->info("-- migrations done");
        $this->call('optimize:clear');

        $this->call('cache:clear');
        Artisan::call('db:seed --class=PostSeeder');
        Artisan::call('db:seed --class=CategorySeeder');
        Artisan::call('db:seed --class=TagSeeder');
        $this->info("-- data added to db");
        $this->call('optimize:clear');
    }
}
