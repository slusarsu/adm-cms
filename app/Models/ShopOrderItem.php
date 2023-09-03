<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShopOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_order_id',
        'shop_product_id',
    ];

    public function shopOrder(): BelongsTo
    {
        return $this->belongsTo(ShopOrder::class);
    }

    public function shopProduct(): BelongsTo
    {
        return $this->belongsTo(ShopProduct::class);
    }
}
