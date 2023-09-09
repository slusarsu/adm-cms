<?php

namespace App\Adm\Services\shop;

use App\Adm\Services\AdmService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ShopProduct;

class ShopProductService
{
    public static function getTemplateName(string $templateNeeded): string
    {
        return AdmService::getTemplateName('template/shop/products', 'product', $templateNeeded);
    }

    public static function getOneBySlug($slug)
    {
        $item = ShopProduct::query()->where('slug', $slug)
            ->active()
            ->locale()
            ->with(['category', 'discount', 'currency'])
            ->first();

        if($item) {
            $item->increment('views');
            $item->save();
        }

        return $item;
    }

    public function getAllByCategorySlug($slug, ?int $paginationCount = 10)
    {
        return ShopProduct::query()
            ->with(['category', 'discount'])
            ->active()
            ->locale()
            ->whereHas('categories', function (Builder $query) use ($slug){
                $query->where('slug', $slug);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($paginationCount);
    }

    public function getAll(?int $paginationCount = 10): LengthAwarePaginator
    {
        return ShopProduct::query()
            ->active()
            ->locale()
            ->with(['category', 'discount'])
            ->orderBy('created_at', 'desc')
            ->paginate($paginationCount);
    }

    public function searchByPhrase(string $phrase, ?int $paginationCount = 10)
    {
        return ShopProduct::query()
            ->active()
            ->locale()
            ->where('title', 'like', '%'.$phrase.'%')
            ->orWhere('content', 'like', '%'.$phrase.'%')
            ->orWhere('short', 'like', '%'.$phrase.'%')
            ->with(['category', 'discount'])
            ->orderBy('created_at', 'desc')
            ->paginate($paginationCount);
    }
}
