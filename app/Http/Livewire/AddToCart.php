<?php

namespace App\Http\Livewire;

use AllowDynamicProperties;
use App\Models\ShopCart;
use App\Models\ShopProduct;
use App\Models\ShopSession;
use Livewire\Component;

#[AllowDynamicProperties] class AddToCart extends Component
{
    public function mount($productId, $quantity = 1): void
    {
        $this->productId = $productId;
        $this->quantity = $quantity;

    }

    public function addToCart()
    {
        $sessionId = session()->getId();
        $userId = auth()->id() ?? null;
        $shopSession = ShopSession::query()->firstOrCreate([
            'session_id' => $sessionId,
        ],[
            'user_id' => $userId,
        ]);

        $cartItem = ShopCart::query()
            ->where('shop_session_id', $sessionId)
            ->where('shop_product_id', $this->productId)->first();

        if($cartItem) {
            $quantity = $cartItem->quantity + $this->quantity;
            $cartItem->till([
                'quantity' => $quantity
            ]);
            $cartItem->save();
        } else {
            $cartItem = ShopCart::query()->updateOrCreate([
                'shop_session_id' => $shopSession->id,
                'shop_product_id' => $this->productId,
                'quantity' => $this->quantity,
            ]);
        }

        $this->emit('cart-reload');

        return $cartItem;
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
