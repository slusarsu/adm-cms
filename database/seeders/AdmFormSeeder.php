<?php

namespace Database\Seeders;

use App\Models\AdmForm;
use Illuminate\Database\Seeder;

class AdmFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdmForm::query()->create([
            'title' => 'Contacts',
            'slug' => 'contacts',
            'is_enabled' => 1,
            'send_notify' => 0,
            'fields' => [
                [
                    "field_name" => "name"
                ],
                [
                    "field_name" => "email"
                ],
                [
                    "field_name" => "subject"
                ],
                [
                    "field_name" => "message"
                ]
            ],
            'link_hash' => 'Mtwstsqf0sLQccF',
        ]);
    }
}
