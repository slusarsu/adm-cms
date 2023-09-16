<?php

namespace App\Http\Livewire;

use Livewire\Component;
use AllowDynamicProperties;
use App\Adm\Services\shop\ShopCartService;

#[AllowDynamicProperties] class AddToCart extends Component
{
    public function mount($productId, $quantity = 1): void
    {
        $this->productId = $productId;
        $this->quantity = $quantity;

    }

    public function addToCart()
    {
        $cartItem = ShopCartService::addToCart($this->productId, $this->quantity);

        $this->emit('cart-reload');

        return $cartItem;
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
