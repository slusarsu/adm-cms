<?php

namespace App\Adm\Services\shop;

use App\Models\ShopCart;

class ShopCartService
{
    public static function addToCart($productId)
    {
        ShopCart::query()->create([
            ''
        ]);
    }
}
