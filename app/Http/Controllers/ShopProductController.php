<?php

namespace App\Http\Controllers;

use App\Adm\Services\shop\ShopProductService;
use Illuminate\Http\Request;

class ShopProductController extends Controller
{
    public function index()
    {

    }

    public function show(Request $request, $slug)
    {

        $item = ShopProductService::getOneBySlug($slug);

        if(!$item) {
            return redirect('/');
        }

        $itemType = $post->type ?? 'product';
        $template = ShopProductService::getTemplateName($itemType);

        return view('template.shop.products.'.$template, compact('item'));
    }
}
