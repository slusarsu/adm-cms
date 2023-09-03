<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShopCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_line1',
        'address_line2',
        'country_id',
        'city',
        'postal_code',
        'phone',
        'mobile',
        'custom_fields',
    ];

    protected $casts = [
        'custom_fields' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
