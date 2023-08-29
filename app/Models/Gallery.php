<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'images',
        'is_enabled',
        'locale',
        'type',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'images' => 'array',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_enabled', true)
            ->where('created_at', '<=',Carbon::now());
    }

    public function scopeLang(Builder $query): void
    {
        $query->where('locale', app()->getLocale());
    }
}
