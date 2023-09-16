<?php

namespace App\Console\Commands;

use Database\Seeders\CountrySeeder;
use Database\Seeders\CurrencySeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AdmShopDemoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adm:shop-demo';

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
        $this->call('optimize:clear');
        Artisan::call('db:seed --class=CountrySeeder');
        Artisan::call('db:seed --class=CurrencySeeder');
        Artisan::call('db:seed --class=ShopCategorySeeder');
        Artisan::call('db:seed --class=ShopProductSeeder');
        $this->info("-- data added to db");
        $this->call('optimize:clear');
    }
}
