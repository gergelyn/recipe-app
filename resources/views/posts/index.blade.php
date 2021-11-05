@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if ($message = Session::get('success'))
        <div class="bg-green-600 text-white w-1/3">
            <strong>Success!</strong>
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="flex mx-48 justify-between">
        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <div class="flex flex-col bg-white shadow-md w-3/12 rounded-xl">
                    <h4 class="ml-6 font-bold text-lg"><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h4>
                    <p class="ml-6 my-2 text-xs">{{ $post->created_at }}</p>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('posts.edit', $post->id) }}" class="rounded-full bg-blue-600 text-white px-4 py-2">Edit</a>
                        <button type="submit" class="rounded-full bg-red-600 text-white px-4 py-2">DELETE</button>
                    </form>
                </div>
            @endforeach
        @else
            <p>No posts found!</p>
        @endif
    </div>
    
@endsection