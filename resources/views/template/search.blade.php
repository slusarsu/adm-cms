@extends('template.layouts.main', [
    'title' => 'Search',
    'seoDescription' => 'Search',
    'seoKeyWords' => 'Search',
    'sidebar' => true,
    ])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="breadcrumbs mb-4">
                <a href="{{homeLink()}}">Home</a>
                <span class="mx-1">/</span>
                <a href="">Search</a>
            </div>
        </div>
        <div class="col-12">
            <h1>Search: {{$phrase}}</h1>
            <form action="{{route('adm-search')}}">
                <div class="input-group mb-3">
                    <input class="form-control" id="search-query" name="s" type="search" placeholder="Search..." autocomplete="off" aria-label="Search  " aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button</button>
                </div>
            </form>
        </div>
        <div class="col-12">
            <x-posts-list :posts="$posts"/>
        </div>
    </div>
@endsection
