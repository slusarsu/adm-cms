<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class ShopCategory extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'parent_id',
        'order',
    ];

    protected $casts = [
        'is_enabled' => 'boolean'
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_enabled', true)
            ->where('created_at', '<=',Carbon::now());
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ShopCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ShopCategory::class, 'parent_id');
    }

    public function shopProducts(): HasMany
    {
        return $this->hasMany(ShopProduct::class);
    }
}
