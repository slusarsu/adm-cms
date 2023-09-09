<?php

namespace App\Models;

use App\Adm\Traits\ModelHasAdmTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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
        'type',
        'characteristics',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'images' => 'array',
        'custom_fields' => 'array',
        'characteristics' => 'array',
        'quantity' => 'integer',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_enabled', true)
            ->where('created_at', '<=',Carbon::now());
    }

    public function scopeLocale(Builder $query): void
    {
        $query->where('locale', null)
            ->orWhere('locale', app()->getLocale());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ShopCategory::class, 'shop_category_id', 'id');
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(ShopDiscount::class, 'shop_discount_id', 'id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class)->where('is_enabled', 1);

    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function link(): string
    {
        return route('shop-product', $this->slug);
    }

    public function thumb()
    {
        return !empty($this->thumb) ?  '/storage/'.$this->thumb : $this->thumb;
    }

    public function images(): array
    {
        $images = [];

        if(empty($this->images)) {
            return $images;
        }

        foreach ($this->images as $image) {
            $images[] = '/storage/'.$image;
        }

        return $images;
    }

    public function getDate()
    {
        return $this->created_at->format('d.m.Y H:i:s');
    }

    public function shortLimited(?int $limit = 50): string
    {
        return Str::limit($this->short, $limit, '...');
    }

    public function currencyCode(): string
    {
        return $this->currency->code ?? '';
    }

    public function characteristics(): array
    {
        return $this->currency->characteristics ?? [];
    }
}
