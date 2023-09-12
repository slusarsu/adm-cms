<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShopSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'session_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(ShopCart::class)->orderByDesc('id');
    }
}
