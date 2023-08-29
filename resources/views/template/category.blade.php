@extends('template.layouts.main', [
    'title' => $category->seo_title ?? $category->title,
    'seoDescription' => $category->seo_description,
    'seoKeyWords' => $category->seo_text_keys,
    'sidebar' => true,
    ])

@section('content')
    <div class="col-12">
        <div class="breadcrumbs mb-4">
            <a href="{{homeLink()}}">Home</a>
            <span class="mx-1">/</span>
            <a href="{{$category->link()}}">Categories</a>
            <span class="mx-1">/</span>
            <a href="{{$category->link()}}">{{$category->title}}</a>
        </div>
        <h1 class="mb-4 border-bottom border-primary d-inline-block">{{$category->title}}</h1>
    </div>
    <x-posts-list :posts="$posts"/>
@endsection
