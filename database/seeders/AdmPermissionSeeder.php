<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Adm\Enums\PermissionEnum;
use Spatie\Permission\Models\Permission;

class AdmPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = PermissionEnum::allValues();

        foreach ($values as $value){
            Permission::create(['name' => $value]);
        }
    }
}
