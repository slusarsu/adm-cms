<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopCategoryController extends Controller
{
    public function index()
    {
        return view('template.shop.categories');
    }

    public function show(Request $request, $slug)
    {
        return view('template.shop.category');
    }
}
