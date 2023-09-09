<?php

namespace Database\Seeders;

use App\Models\ShopProduct;
use Illuminate\Database\Seeder;

class ShopProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShopProduct::factory(33)->create();
    }
}
