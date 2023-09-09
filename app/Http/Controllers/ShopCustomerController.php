<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopCustomerController extends Controller
{
    public function index()
    {
        return view('template.shop.customer');
    }
}
