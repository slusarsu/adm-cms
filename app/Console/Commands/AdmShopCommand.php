<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AdmShopCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adm:shop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add shop';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('migrate --path=/database/migrations/shop');
        $this->info("-- migrations done");
        $this->call('optimize:clear');

        $this->call('cache:clear');
        Artisan::call('db:seed --class=PostSeeder');
        Artisan::call('db:seed --class=CategorySeeder');
        Artisan::call('db:seed --class=TagSeeder');
        Artisan::call('db:seed --class=ShopCategorySeeder');
        Artisan::call('db:seed --class=ShopProductSeeder');
        $this->info("-- data added to db");
        $this->call('optimize:clear');
    }
}
