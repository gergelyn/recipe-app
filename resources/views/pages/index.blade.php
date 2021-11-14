@extends('layouts.app')

@section('content')
    <form action="/search" method="GET" class="grid grid-cols-3 gap-4">
        <input type="search" name="query" id="query" class="border-2 border-black rounded-md px-4 py-2" placeholder="Search Recipe">
        <select name="difficulty_id" id="difficulty_id" class="border-2 border-black rounded-md px-4 py-2">
            @foreach ($difficulties as $difficulty)
                <option value="{{ $difficulty->id }}">{{ $difficulty->level }}</option>
            @endforeach
        </select>
        <select name="meal_type_id" id="meal_type_id" class="border-2 border-black rounded-md px-4 py-2">
            @foreach ($meal_types as $meal_type)
                <option value="{{ $meal_type->id }}">{{ $meal_type->meal_type }}</option>
            @endforeach
        </select>
    </form>
@endsection