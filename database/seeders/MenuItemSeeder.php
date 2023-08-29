<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'title' => 'About',
                'link' => '/about',
                'order' => 1,
                'menu_id' => 1,
            ],
            [
                'title' => 'Categories',
                'link' => '/categories',
                'order' => 2,
                'menu_id' => 1,
            ],
            [
                'title' => 'Contacts',
                'link' => '/contacts',
                'order' => 3,
                'menu_id' => 1,
            ],
            [
                'title' => 'About',
                'link' => '/about',
                'order' => 1,
                'menu_id' => 2,
            ],
            [
                'title' => 'Privacy Policy',
                'link' => '/privacy-policy',
                'order' => 2,
                'menu_id' => 2,
            ],
            [
                'title' => 'Terms And Conditions',
                'link' => '/terms-conditions',
                'order' => 3,
                'menu_id' => 2,
            ],
            [
                'title' => 'Categories',
                'link' => '/categories',
                'order' => 4,
                'menu_id' => 2,
            ],
            [
                'title' => 'Contacts',
                'link' => '/contacts',
                'order' => 5,
                'menu_id' => 2,
            ],
        ];

        foreach ($items as $menu) {
            MenuItem::query()->create($menu);
        }
    }
}
