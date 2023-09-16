<?php

namespace App\Adm\Services\shop;

use App\Models\ShopCart;
use App\Models\ShopSession;

class ShopCartService
{
    public static function addToCart($productId, $quantity)
    {
        $sessionId = session()->getId();
        $userId = auth()->id() ?? null;

        $cartItem = ShopCart::query()->where('session_id', $sessionId);

        if($userId) {
            $cartItem = ShopCart::query()->where('user_id', $userId);
        }

        $cartItem =  $cartItem->where('product_id', $productId)->first();

        if($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cartItem = ShopCart::query()->updateOrCreate([
                'session_id' => $sessionId,
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return $cartItem;
    }

    public function getCartItems()
    {
        $sessionId = session()->getId();
        $userId = auth()->id() ?? null;

        $cartItems = ShopCart::query()->where('session_id', $sessionId);

        if($userId) {
            $cartItems = ShopCart::query()->where('user_id', $userId);
        }

        $cartItems =  $cartItems->with('product')->orderByDesc('id')->get();

        return $cartItems;
    }

    public function getProductsFromCartItems($items)
    {
        return $items->map(function ($item) {
            $item->product->cart_id = $item->id;
            $item->product->quantity_items = $item->quantity;
            $item->product->cart_price = $item->product->price * $item->quantity;
            return $item->product;
        });
    }
}
