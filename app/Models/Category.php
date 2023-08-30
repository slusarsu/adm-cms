<?php

namespace App\Models;

use App\Adm\Traits\ModelHasAdmTranslation;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property int $parent_id
 * @property string $title
 * @property string $slug
 * @property string $order
 */
class Category extends Model
{
    use HasFactory;
    use ModelHasAdmTranslation;

    protected $fillable = [
        'parent_id',
        'title',
        'slug',
        'order',
        'content',
        'thumb',
        'is_enabled',
        'post_type',
        'content_type',
        'locale',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
    ];

    public function scopeLocale(Builder $query): void
    {
        $query->where('locale', null)
            ->orWhere('locale', app()->getLocale());
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_enabled', true)
            ->where('created_at', '<=',Carbon::now());
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'categorize');
    }

    public static function tree()
    {
        $allCategories = Category::query()->active()->get();

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
        return route('category', $this->slug);
    }

    public function thumb()
    {
        return !empty($this->thumb) ?  '/storage/'.$this->thumb : $this->thumb;
    }

}
