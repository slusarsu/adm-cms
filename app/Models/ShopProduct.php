<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShopProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'short',
        'content',
        'thumb',
        'images',
        'is_enabled',
        'views',
        'locale',
        'seo_title',
        'seo_text_keys',
        'seo_description',
        'price',
        'quantity',
        'sku',
        'shop_category_id',
        'shop_discount_id',
    ];

    protected $casts = [
        'is_enabled' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shopCategory(): BelongsTo
    {
        return $this->belongsTo(ShopCategory::class);
    }

    public function shopDiscount(): BelongsTo
    {
        return $this->belongsTo(ShopDiscount::class);
    }
}
