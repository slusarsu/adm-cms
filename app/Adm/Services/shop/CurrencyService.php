<?php

namespace App\Adm\Services\shop;

use App\Models\Currency;

class CurrencyService
{
    public static function getList()
    {
        return Currency::query()->active()->pluck('code', 'id');
    }
}
