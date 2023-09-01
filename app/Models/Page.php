<?php

namespace App\Models;

use App\Adm\Traits\ModelHasAdmTranslation;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ModelHasAdmTranslation;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'short',
        'content',
        'template',
        'custom_fields',
        'thumb',
        'images',
        'is_enabled',
        'seo_title',
        'seo_text_keys',
        'seo_description',
        'views',
        'locale',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'custom_fields' => 'array',
        'images' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_enabled', true)
            ->where('created_at', '<=',Carbon::now());
    }

    public function customFields(): array
    {
        $fields = [];

        if(empty($this->custom_fields)) {
            return $fields;
        }

        foreach($this->custom_fields as $field) {
            $fieldName = $field['data']['field_name'];
            $dataField= Arr::where($field['data'], function ($value, $key) {
                return $key != 'field_name';
            });
            $fields[$fieldName] = Arr::first($dataField);
        }
        return $fields;
    }

    public function link(): string
    {
        return route('page', $this->slug);
    }

    public function thumb()
    {
        return !empty($this->thumb) ?  '/storage/'.$this->thumb : $this->thumb;
    }

    public function images(): array
    {
        $images = [];

        if(empty($this->images)) {
            return $images;
        }

        foreach ($this->images as $image) {
            $images[] = '/storage/'.$image;
        }

        return $images;
    }

    public function getDate()
    {
        return $this->created_at->format('d.m.Y H:i');
    }
}
