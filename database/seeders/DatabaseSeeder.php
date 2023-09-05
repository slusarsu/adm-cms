<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        app()->call(AdmPermissionSeeder::class);
        app()->call(AdmRoleSeeder::class);
        app()->call(AdmUserSeeder::class);
        app()->call(PageSeeder::class);
        app()->call(AdmFormSeeder::class);
        app()->call(MenuSeeder::class);
        app()->call(MenuItemSeeder::class);
        app()->call(CurrencySeeder::class);
        app()->call(CountrySeeder::class);
    }

    public function sleep()
    {
        sleep(1);
    }
}
