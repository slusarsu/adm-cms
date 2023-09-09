<?php

namespace Database\Seeders;

use App\Models\ShopCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShopCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShopCategory::query()->create([
            'title' => 'Category 1',
            'slug' => 'category-1',
            'order' => 1,
        ]);

        ShopCategory::query()->create([
            'title' => 'Category 2',
            'slug' => 'category-2',
            'order' => 2,
        ]);

        ShopCategory::query()->create([
            'title' => 'Category 3',
            'slug' => 'category-3',
            'order' => 3,
        ]);

        ShopCategory::query()->create([
            'title' => 'Category 4',
            'slug' => 'category-4',
            'order' => 4,
        ]);

        ShopCategory::query()->create([
            'title' => 'Category 5',
            'slug' => 'category-5',
            'order' => 5,
        ]);
    }
}
