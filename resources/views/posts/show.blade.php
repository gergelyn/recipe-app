@extends('layouts.app')

@section('content')
    <div class="mx-auto w-1/2">
{{--        <img src="{{ $image->post_image_path }}" alt="{{ $image->post_image_caption }}">--}}
        <h1 class="text-lg font-bold mt-4">{{ $post->title }}</h1>
        <hr class="my-4">
        <p>{!! $post->body !!}</p>
        <hr class="my-4">
        <small class="mr-2">{{ $post->author->name }}</small>|<small class="ml-2">{{ date("Y.m.d", strtotime($post->created_at)) }}</small>
    </div>
@endsection
