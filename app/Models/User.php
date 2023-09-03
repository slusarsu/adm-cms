<?php

namespace App\Models;

use App\Adm\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function shopCustomer(): HasOne
    {
        return $this->hasOne(ShopCustomer::class);
    }

    public function shopOrders(): HasMany
    {
        return $this->hasMany(ShopOrder::class);
    }

    public function shopProducts(): HasMany
    {
        return $this->hasMany(ShopProduct::class);
    }

    public function shopSessions(): HasMany
    {
        return $this->hasMany(ShopSession::class);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(RoleEnum::ADMIN->value);
    }
}
