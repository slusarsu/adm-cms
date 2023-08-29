@extends('template.layouts.main', [
    'title' => 'Categories',
    'seoDescription' => 'Categories',
    'seoKeyWords' => 'Categories',
    'sidebar' => true,
    ])

@section('content')
    <div class="col-12">
        <div class="breadcrumbs mb-4">
            <a href="{{homeLink()}}">Home</a>
            <span class="mx-1">/</span>
            <a href="{{route('categories')}}">Categories</a>
        </div>

    </div>
    @if(!empty($categories))
        <div class="row">
            @foreach($categories as $key => $category)

                <div class="col-md-6 mb-4" id="category-{{$category->id}}">
                    <article class="card article-card article-card-sm h-100">
                        <a href="{{$category->link()}}">
                            <div class="card-image">
                                <img loading="lazy" decoding="async" src="{{$category->thumb() ?? admRandomImage()}}" alt="{{$category->title}}" class="w-100">
                            </div>
                        </a>
                        <div class="card-body px-0 pb-0">
                            <h2>
                                <a class="post-title" href="{{$category->link()}}">{{$category->title}}</a>
                            </h2>
                            <p class="card-text">{!! $category->short !!}</p>
                        </div>
                    </article>
                </div>

            @endforeach
        </div>
    @endif

@endsection
