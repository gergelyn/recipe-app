@extends('layouts.app')

@section('content')
    <h1 class="text-lg font-bold mb-4">Blog posztok</h1>
    @auth
    <a href="{{ route('posts.create') }}" class="rounded-full bg-green-600 text-white px-4 py-2">Poszt kiírása</a>
    @endauth

    @if ($message = Session::get('status'))
        <div class="bg-green-600 text-white w-1/3">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="grid grid-cols-3 gap-4 mt-4">
        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <div class="flex flex-col bg-white shadow-md rounded-xl">
                    <img style="height: 200px" src="{{ $post->cover_image->post_image_path }}" alt="{{ $post->cover_image->post_image_caption }}">
                    <h4 class="ml-6 font-bold text-lg"><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h4>
                    <p class="ml-6 my-2 text-xs">{{ date("Y.m.d", strtotime($post->created_at)) }}</p>
                    <p class="ml-6 my-2 text-xs">{{ $post->author->name }}</p>
                    <div class="ml-4 mb-4">
                        @auth
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('posts.edit', $post->id) }}" class="rounded-full bg-blue-600 text-white px-4 py-2">Szerkesztés</a>
                            <button type="submit" class="rounded-full bg-red-600 text-white px-4 py-1.5">Törlés</button>
                        </form>
                        @endauth
                    </div>
                </div>
            @endforeach
        @else
            <p>Nem található poszt!</p>
        @endif
    </div>

@endsection
