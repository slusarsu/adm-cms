<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShopCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_session_id',
        'shop_product_id',
        'quantity',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(ShopSession::class, 'shop_session_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(ShopProduct::class, 'shop_product_id', 'id');
    }
}
