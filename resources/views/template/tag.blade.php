@extends('template.layouts.main', [
    'title' => $tag->seo_title ?? $tag->title,
    'seoDescription' => $tag->seo_description,
    'seoKeyWords' => $tag->seo_text_keys,
    'sidebar' => true,
    ])

@section('content')
    <div class="col-12">
        <div class="breadcrumbs mb-4">
            <a href="{{homeLink()}}">Home</a>
            <span class="mx-1">/</span>
            <a href="{{$tag->link()}}">Tags</a>
            <span class="mx-1">/</span>
            <a href="{{$tag->link()}}">{{$tag->title}}</a>
        </div>
        <h1 class="mb-4 border-bottom border-primary d-inline-block">{{$tag->title}}</h1>
    </div>
    <x-posts-list :posts="$posts"/>
@endsection
