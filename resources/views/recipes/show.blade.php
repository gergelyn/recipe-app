@extends('layouts.app')

@section('content')
    <img src="{{ $recipe->recipe_image_path }}" alt="{{ $recipe->recipe_image_caption }}">
    <h1 class="text-lg font-bold">{{ $recipe->title }}</h1>
    <p>{{ $recipe->cook_time }}</p>
    <p>{{ $recipe->level }}</p>
    <p>{{ $recipe->meal_type }}</p>
    <small>{{ $recipe->created_at }}</small>
@endsection