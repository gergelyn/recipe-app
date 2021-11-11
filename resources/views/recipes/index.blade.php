@extends('layouts.app')

@section('content')
    <h1 class="text-lg font-bold mb-2">Recipes</h1>
    <a href="{{ route('recipes.create') }}" class="rounded-full bg-green-600 text-white px-4 py-2">Create</a>
    @if ($message = Session::get('success'))
        <div class="bg-green-600 text-white w-1/3">
            <strong>Success!</strong>
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="grid grid-cols-3 gap-4 mt-4">
        @if (count($recipes) > 0)
            @foreach ($recipes as $recipe)
                @dump($recipe)
                <div class="flex flex-col bg-white shadow-md rounded-xl">
                    <img src="{{ $recipe->recipe_image_path }}" alt="{{ $recipe->recipe_image_caption }}">
                    <h4 class="ml-6 font-bold text-lg"><a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a></h4>
                    <span class="ml-6 my-2 text-xs">{{ $recipe->created_at }}</span>
                    <span class="ml-6 my-2 text-xs">{{ Str::title($recipe->level) }}</span>
                    <span class="ml-6 my-2 text-xs">{{ Str::title($recipe->meal_type) }}</span>
                    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="rounded-full bg-blue-600 text-white px-4 py-2">Edit</a>
                        <button type="submit" class="rounded-full bg-red-600 text-white px-4 py-1.5">Delete</button>
                    </form>
                </div>
            @endforeach
        @else
            <p>No recipes found!</p>
        @endif
    </div>
    
@endsection