@extends('layouts.app')

@section('content')
    <img src="{{ $cover_image->recipe_image_path }}" alt="{{ $cover_image->recipe_image_caption }}">
    <h1 class="text-lg font-bold">{{ $recipe->title }}</h1>
    <p>{{ $recipe->cook_time }}</p>
    <p>{{ $difficulty }}</p>
    <p>{{ $meal_type }}</p>
    <small>{{ $recipe->author->name }}</small>
    <small>{{ $recipe->created_at }}</small>
@endsection