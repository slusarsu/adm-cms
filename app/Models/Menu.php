<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'is_enabled',
        'locale',
        'position',
    ];
    protected $casts = [
        'is_enabled' => 'boolean'
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

    public function scopeLang(Builder $query): void
    {
        $query->where('locale', app()->getLocale());
    }

    public function menu_items()
    {
        return $this->hasMany(MenuItem::class)->active()->orderBy('order');
    }
}
