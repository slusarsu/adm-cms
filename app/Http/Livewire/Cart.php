<?php

namespace App\Http\Livewire;

use AllowDynamicProperties;
use App\Adm\Services\shop\ShopCartService;
use App\Models\ShopCart;
use App\Models\ShopSession;
use Livewire\Component;

class Cart extends Component
{
    protected $listeners = ['cart-reload' => 'load'];
    public $items;
    public $count;

    public function mount()
    {
        $this->load();
    }

    public function load()
    {
        $carts = resolve(ShopCartService::class)->getCartItems();
        $this->items = resolve(ShopCartService::class)->getProductsFromCartItems($carts);

        $this->count = $this->items->sum('quantity_items');

    }
    public function render()
    {
        return view('livewire.cart');
    }
}
