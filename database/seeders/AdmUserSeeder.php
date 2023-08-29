<?php

namespace Database\Seeders;

use App\Adm\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdmUserSeeder extends Seeder
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

        $role = Role::query()->where('name', RoleEnum::ADMIN->value)->first();

        $user->assignRole($role);
    }
}
