<?php

namespace App\Models;

use App\Adm\Traits\ModelHasAdmTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class ShopProduct extends Model
{
    use HasFactory;
    use ModelHasAdmTranslation;

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
        'currency_id',
        'custom_fields',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'images' => 'array',
        'custom_fields' => 'array',
        'quantity' => 'integer',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_enabled', true)
            ->where('created_at', '<=',Carbon::now());
    }

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

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class)->where('is_enabled', 1);

    }
}
