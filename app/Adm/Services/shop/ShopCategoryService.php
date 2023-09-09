<?php

namespace App\Adm\Services\shop;

use App\Models\ShopCategory;

class ShopCategoryService
{
    public function getOneBySlug($slug)
    {
        return ShopCategory::query()->where('slug', $slug)->active()->first();
    }

    public static function getAllParents()
    {
        return ShopCategory::query()
            ->whereNull('parent_id')
            ->withCount('products')
            ->active()
            ->locale()
            ->orderby('order')
            ->get();
    }

}
