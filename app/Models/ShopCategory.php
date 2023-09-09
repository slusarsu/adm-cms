<?php

namespace App\Models;

use App\Adm\Traits\ModelHasAdmTranslation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class ShopCategory extends Model
{
    use HasFactory;
    use ModelHasAdmTranslation;

    protected $fillable = [
        'title',
        'slug',
        'short',
        'content',
        'thumb',
        'images',
        'is_enabled',
        'views',
        'locale',
        'seo_title',
        'seo_text_keys',
        'seo_description',
        'parent_id',
        'order',
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

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ShopCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ShopCategory::class, 'parent_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(ShopProduct::class);
    }

    public static function tree()
    {
        $allCategories = ShopCategory::query()->active()->get();

        $rootCategories = $allCategories->whereNull('parent_id');

        self::formatTree($rootCategories, $allCategories);

        return $rootCategories;
    }

    private static function formatTree($rootCategories, $allCategories): void
    {
        foreach ($rootCategories as $category) {
            $category->sub_cat = $allCategories->where('parent_id', $category->id)->values();

            if ($category->sub_cat->isNotEmpty()) {
                self::formatTree($category->sub_cat, $allCategories);
            }
        }
    }

    public function link(): string
    {
        return route('shop-category', $this->slug);
    }

    public function thumb()
    {
        return !empty($this->thumb) ?  '/storage/'.$this->thumb : $this->thumb;
    }
}
