<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'title' => 'Top Menu',
                'slug' => 'top-menu',
                'position' => 'header',
            ],
            [
                'title' => 'Footer Menu',
                'slug' => 'footer-menu',
                'position' => 'footer',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::query()->create($menu);
        }
    }
}
