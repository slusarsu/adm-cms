<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class ShopDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'is_enabled',
        'is_percent',
        'amount',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'is_percent' => 'boolean'
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_enabled', true)
            ->where('created_at', '<=',Carbon::now());
    }

    public function products(): HasMany
    {
        return $this->hasMany(ShopProduct::class);
    }
}
