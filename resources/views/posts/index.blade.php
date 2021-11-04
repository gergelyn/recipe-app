@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="flex flex-col bg-white shadow-md w-3/12 rounded-xl">
                <h4 class="ml-6 font-bold text-lg"><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h4>
                <p class="ml-6 my-2 text-xs">{{ $post->created_at }}</p>
            </div>
        @endforeach
    @else
        <p>No posts found!</p>
    @endif
@endsection