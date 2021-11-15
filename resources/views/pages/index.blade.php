@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-3 gap-4 mt-4">
        @if ($soup === null)
            <p>Nem található leves!</p>
        @else
        <div class="flex flex-col bg-white shadow-md rounded-xl">
            <img src="{{ $soup->cover_image->recipe_image_path }}" alt="{{ $soup->cover_image->recipe_image_caption }}">
            <h4 class="ml-6 font-bold text-lg"><a href="/recipes/{{ $soup->id }}">{{ $soup->title }}</a></h4>
            <span class="ml-6 my-2 text-xs">{{ date("Y-m-d", strtotime($soup->created_at)) }}</span>
            <span class="ml-6 my-2 text-xs">{{ Str::title($difficulties->find($soup->difficulty_id)->level) }}</span>
            <span class="ml-6 my-2 text-xs">{{ Str::title($meal_types->find($soup->meal_type_id)->meal_type) }}</span>
        </div>
        @endif
        @if ($main_course === null)
            <p>Nem található fôétel!</p>
        @else
        <div class="flex flex-col bg-white shadow-md rounded-xl">
            <img src="{{ $main_course->cover_image->recipe_image_path }}" alt="{{ $main_course->cover_image->recipe_image_caption }}">
            <h4 class="ml-6 font-bold text-lg"><a href="/recipes/{{ $main_course->id }}">{{ $main_course->title }}</a></h4>
            <span class="ml-6 my-2 text-xs">{{ date("Y-m-d", strtotime($main_course->created_at)) }}</span>
            <span class="ml-6 my-2 text-xs">{{ Str::title($difficulties->find($main_course->difficulty_id)->level) }}</span>
            <span class="ml-6 my-2 text-xs">{{ Str::title($meal_types->find($main_course->meal_type_id)->meal_type) }}</span>
        </div>
        @endif
        @if ($dessert === null)
            <p>Nem található desszert!</p>
        @else
        <div class="flex flex-col bg-white shadow-md rounded-xl">
            <img src="{{ $dessert->cover_image->recipe_image_path }}" alt="{{ $dessert->cover_image->recipe_image_caption }}">
            <h4 class="ml-6 font-bold text-lg"><a href="/recipes/{{ $dessert->id }}">{{ $dessert->title }}</a></h4>
            <span class="ml-6 my-2 text-xs">{{ date("Y-m-d", strtotime($dessert->created_at)) }}</span>
            <span class="ml-6 my-2 text-xs">{{ Str::title($difficulties->find($dessert->difficulty_id)->level) }}</span>
            <span class="ml-6 my-2 text-xs">{{ Str::title($meal_types->find($dessert->meal_type_id)->meal_type) }}</span>
        </div>
        @endif
        
    </div>
@endsection