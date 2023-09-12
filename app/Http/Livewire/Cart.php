<?php

namespace App\Http\Livewire;

use AllowDynamicProperties;
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
        $sessionId = session()->getId();
        $shopSession = ShopSession::query()->where('session_id', $sessionId)->with('carts.product')->first();
        $this->items = $shopSession->carts;
        $this->count = $this->items->count();
    }
    public function render()
    {
        return view('livewire.cart');
    }
}
