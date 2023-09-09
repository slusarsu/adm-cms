@extends('template.layouts.main', [
    'title' => trans('shop.shop'),
    'seoDescription' => trans('shop.shop'),
    'seoKeyWords' => trans('shop.shop'),
//    'sidebar' => false,
    ])

@section('content')
    <div class="row p-3">
        <div class="col-10">
            <div class="breadcrumbs mb-4">
                <a href="{{homeLink()}}">Home</a>
                <span class="mx-1">/</span>
                <a href="{{route('shop-index')}}">{{trans('shop.shop')}}</a>
            </div>
        </div>
        <div class="col-2">
            <livewire:cart />
        </div>

        <div class="col-12">
            <div class="my-3">
                <x-product-list :items="$items"/>
            </div>
        </div>
    </div>


@endsection
