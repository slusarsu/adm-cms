<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $popularCurrencies = [
            [
                'code' => 'UAH',
                'name' => 'Ukrainian Hryvnia',
                'symbol' => '₴',
            ],
            [
                'code' => 'USD',
                'name' => 'United States Dollar',
                'symbol' => '$',
            ],
            [
                'code' => 'EUR',
                'name' => 'Euro',
                'symbol' => '€',
            ],
            [
                'code' => 'GBP',
                'name' => 'British Pound Sterling',
                'symbol' => '£',
            ],
        ];

        foreach ($popularCurrencies as $currencyData) {
            Currency::query()->create($currencyData);
        }
    }
}
