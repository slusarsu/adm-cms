<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShopDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'is_enabled',
        'percent',
        'amount',
    ];

    protected $casts = [
        'is_enabled' => 'boolean'
    ];

    public function shopProducts(): HasMany
    {
        return $this->hasMany(ShopProduct::class);
    }
}
