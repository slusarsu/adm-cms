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
        'address_line_1',
        'address_line_2',
        'country_id',
        'city',
        'postal_code',
        'phone',
        'mobile',
        'custom_fields',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function countries(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
