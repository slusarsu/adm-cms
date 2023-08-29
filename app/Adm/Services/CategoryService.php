<?php

namespace App\Adm\Services;

use App\Models\Category;

class CategoryService
{
    public function getOneBySlug($slug)
    {
        return Category::query()->where('slug', $slug)->active()->first();
    }

    public static function getAllParents()
    {
        return Category::query()
            ->whereNull('parent_id')
            ->withCount('posts')
            ->active()
            ->orderby('order')
            ->get();
    }
}
