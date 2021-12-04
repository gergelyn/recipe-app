@extends('layouts.app')

@section('content')
    <div class="flex flex-row">
        <div class="flex items-center">
            <form action="/search" method="GET">
                <input type="search" name="query" id="query" class="border-2 border-yellow-600 rounded-full px-4 py-2" placeholder="Recept keresés">
            </form>
        </div>
        <button class="bg-yellow-600 rounded-full px-4 py-2 text-white ml-2">KERESÉS</button>
    </div>
    @auth
    <div class="my-6">
        <a href="{{ route('recipes.create') }}" class="rounded-full bg-green-600 text-white px-4 py-2">Recept posztolás</a>
    </div>
    @endauth
    @if ($message = Session::get('status'))
        <div class="bg-green-600 text-white w-1/3">
            <p>{{ $message }}</p>
        </div>
    @endif


    <div class="grid grid-cols-3 gap-4 mt-4">
        @if ($recipes->count())
            @foreach ($recipes as $recipe)
                <div class="flex flex-col bg-white shadow-md rounded-xl">
                    <img style="height: 200px" src="{{ $recipe->cover_image->recipe_image_path }}" alt="{{ $recipe->cover_image->recipe_image_caption }}">
                    <h4 class="ml-6 mt-4 font-bold text-lg"><a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a></h4>
                    <span class="ml-6 my-2 text-xs">{{ $recipe->author->name }}-tól</span>
                    <div class="mb-2 flex flex-row justify-between">
                        <span class="ml-6 my-2 text-xs">{{ $recipe->cook_time }} perc</span>
                        <span class="mr-16 my-2 text-xs">{{ Str::title($difficulties->find($recipe->difficulty_id)->level) }}</span>
                    </div>
                    @auth
                    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="rounded-full bg-blue-600 text-white px-4 py-2">Szerkesztés</a>
                        <button type="submit" class="rounded-full bg-red-600 text-white px-4 py-1.5">Törlés</button>
                    </form>
                    @endauth
                </div>
            @endforeach
        @else
            <p>Nem található recept!</p>
        @endif
    </div>

@endsection
