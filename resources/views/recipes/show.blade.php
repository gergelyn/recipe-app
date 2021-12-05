@extends('layouts.app')

@section('content')
    <div class="mx-auto w-1/2">

        <img src="{{ $cover_image->recipe_image_path }}" alt="{{ $cover_image->recipe_image_caption }}" class="mb-6">
        <h1 class="text-lg font-bold mb-4">{{ $recipe->title }}</h1>

        <div class="flex flex-row">
            <p class="mr-2">{{ $recipe->cook_time }} perc</p>|
            <p class="mx-2">{{ $difficulty }}</p>|
            <p class="mx-2">{{ $meal_type }}</p>
        </div>

        <hr class="my-4">

        <h3 class="text-md font-bold">Hozzávalók</h3>
        <form action="#"></form>
            @foreach ($recipe->ingredients as $ingredient)
            <li>
                <span>{{ $ingredient->measurement_qty->amount }}</span>
                <span>{{ $ingredient->measurement_unit->unit_type }}</span>
                <span>{{ $ingredient->ingredient_name->ingredient_name }}</span>
            </li>
            @endforeach
        </form>

        <hr class="my-4">

        <h3 class="text-md font-bold">Elkészítés</h3>
        <ol class="list-decimal">
            @foreach ($instructions as $instruction)
                <li class="ml-4">{{ $instruction->instruction_text }}</li>
            @endforeach
        </ol>

        <hr class="my-4">

        <small>Recept készítője: {{ $recipe->author->name }}</small>
    </div>
@endsection
