<?php

namespace Database\Seeders;

use App\Models\ShopCustomer;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);

        $customer = ShopCustomer::query()->create([
            'user_id' => $user->id
        ]);
    }
}
