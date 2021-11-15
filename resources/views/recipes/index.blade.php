@extends('layouts.app')

@section('content')
    <h1 class="text-lg font-bold mb-2">Receptek</h1>
    @auth
    <a href="{{ route('recipes.create') }}" class="rounded-full bg-green-600 text-white px-4 py-2">Recept posztolás</a>
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
                    <img src="{{ $recipe->cover_image->recipe_image_path }}" alt="{{ $recipe->cover_image->recipe_image_caption }}">
                    <h4 class="ml-6 font-bold text-lg"><a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a></h4>
                    <span class="ml-6 my-2 text-xs">{{ date("Y-m-d", strtotime($recipe->created_at)) }}</span>
                    <span class="ml-6 my-2 text-xs">{{ Str::title($difficulties->find($recipe->difficulty_id)->level) }}</span>
                    <span class="ml-6 my-2 text-xs">{{ Str::title($meal_types->find($recipe->meal_type_id)->meal_type) }}</span>
                    <span class="ml-6 my-2 text-xs">{{ $recipe->author->name }}</span>
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