@extends('template.layouts.main',[
    'sidebar' => true,
])

@section('content')

    <x-posts-list :posts="$posts"/>
@endsection
