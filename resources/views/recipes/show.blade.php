@extends('layouts.app')

@section('content')
    <img src="{{ $cover_image->recipe_image_path }}" alt="{{ $cover_image->recipe_image_caption }}">
    <h1 class="text-lg font-bold">{{ $recipe->title }}</h1>
    <p>{{ $recipe->cook_time }}</p>
    <p>{{ $difficulty }}</p>
    <p>{{ $meal_type }}</p>
    <h3 class="text-md font-bold">Alapanyagok</h3>
    <form action="#"></form>
        @foreach ($recipe->ingredients as $ingredient)
        <li>
            <span>{{ $ingredient->measurement_qty->amount }}</span>
            <span>{{ $ingredient->measurement_unit->unit_type }}</span>
            <span>{{ $ingredient->ingredient_name->ingredient_name }}</span>
        </li>
        @endforeach
    </form>
    <h3 class="text-md font-bold">Elkészítés</h3>
    <ol class="list-decimal">
        @foreach ($instructions as $instruction)
            <li class="ml-4">{{ $instruction->instruction_text }}</li>
        @endforeach
    </ol>

    <small>{{ $recipe->author->name }}</small>
    <small>{{ $recipe->created_at }}</small>
@endsection