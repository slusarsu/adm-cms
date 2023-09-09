<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Adm\Services\shop\ShopCategoryService;
use App\Adm\Services\shop\ShopProductService;
use App\Adm\Services\shop\ShopService;
use Illuminate\Http\Request;

#[AllowDynamicProperties] class ShopController extends Controller
{
    public function __construct(ShopService $shopService, ShopProductService $shopProductService, ShopCategoryService $shopCategoryService)
    {
        $this->shopService = $shopService;
        $this->shopProductService = $shopProductService;
        $this->shopCategoryService = $shopCategoryService;
    }

    public function index(Request $request)
    {
        $items = $this->shopProductService->getAll(shopPaginationCount());

        return view('template.shop.index', compact('items'));
    }
}
