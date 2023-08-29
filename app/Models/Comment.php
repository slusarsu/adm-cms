<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_id',
        'content',
        'is_enabled',
        'commentable_id',
        'commentable_type',
        'email',
        'ip',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_enabled', true)
            ->where('created_at', '<=',Carbon::now());
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getDate()
    {
        return $this->created_at->format('d.m.Y H:i:s');
    }

    public function emailName(): string
    {
        $emailArr = explode('@', $this->email);

        return $emailArr[0];
    }
}
