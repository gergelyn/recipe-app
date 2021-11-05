@extends('layouts.app')

@section('content')
    <h1 class="text-lg font-bold">Poszt szerkesztése</h1>
    <a href="{{ route('posts.index') }}" class="rounded-full bg-blue-600 text-white px-4 py-2">Back</a>
    @if ($errors->any())
        <div class="bg-red-600 text-white w-1/3">
            <strong>Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('posts.update', $post->id) }}" method="POST" class="flex flex-col w-1/3">
        @csrf
        @method('PUT')
        <label for="title">Cím</label>
        <input id="title" type="text" name="title" class="border-2 border-black rounded-md" value="{{ $post->title }}">
        <label for="body">Szöveg</label>
        <textarea id="body" name="body" class="border-2 border-black rounded-md" rows="5">{{ $post->body }}</textarea>
        <button type="submit" class="p-3 border border-yellow-600 bg-yellow-600 rounded-full text-white hover:border-yellow-700 hover:bg-yellow-700">Szerkesztés befejezése</button>
    </form>
@endsection