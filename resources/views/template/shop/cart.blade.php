@extends('template.layouts.main', [
    'title' => trans('shop.cart'),
    'seoDescription' => trans('shop.cart'),
    'seoKeyWords' => trans('shop.cart'),
//    'sidebar' => false,
    ])

@section('content')
    <div class="row p-3">
        <div class="col-12">
            <div class="breadcrumbs mb-4">
                <a href="{{homeLink()}}">Home</a>
                <span class="mx-1">/</span>
                <a href="{{route('shop-index')}}">{{trans('shop.shop')}}</a>
                <span class="mx-1">/</span>
                <a href="{{route('shop-cart')}}">{{trans('shop.cart')}}</a>
            </div>
        </div>
    </div>
@endsection
