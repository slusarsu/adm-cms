@extends('template.layouts.main',[
    'sidebar' => true,
])

@section('content')
    @lang('test.test')
    <x-posts-list :posts="$posts"/>
@endsection
