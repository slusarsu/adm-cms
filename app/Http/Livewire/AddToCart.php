<?php

namespace App\Http\Livewire;

use AllowDynamicProperties;
use App\Models\ShopCart;
use App\Models\ShopProduct;
use Livewire\Component;

#[AllowDynamicProperties] class AddToCart extends Component
{
    public function mount(ShopProduct $product): void
    {
        $this->product = $product;
    }

    public function addToCart()
    {

    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
