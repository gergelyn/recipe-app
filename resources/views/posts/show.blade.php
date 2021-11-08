@extends('layouts.app')

@section('content')
    <img src="{{ $image->post_image_path }}" alt="{{ $image->post_image_caption }}">
    <h1 class="text-lg font-bold">{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    <small>{{ $post->created_at }}</small>
@endsection