@extends('layouts.app')

@section('content')
    <h1 class="text-lg font-bold">Recept szerkesztése</h1>
    <a href="{{ route('recipes.index') }}" class="rounded-full bg-blue-600 text-white px-4 py-2">Back</a>
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
    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" class="flex flex-col w-1/3" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="image">Recept képe</label>
        <input type="file" name="image" id="image" accept="image/*">
        <label for="title">Cím</label>
        <input id="title" type="text" name="title" class="border-2 border-black rounded-md" value="{{ $recipe->title }}">
        <label for="cook_time">Idô</label>
        <input id="cook_time" type="number" name="cook_time" class="border-2 border-black rounded-md" value="{{ $recipe->cook_time }}">
        <label for="difficulty_id">Nehézség</label>
        <select name="difficulty_id" id="difficulty_id">
            @foreach ($difficulties as $difficulty)
                <option value="{{ $difficulty->id }}">{{ $difficulty->level }}</option>
            @endforeach
        </select>
        <label for="meal_type_id">Típus</label>
        <select name="meal_type_id" id="meal_type_id">
            @foreach ($meal_types as $meal_type)
                <option value="{{ $meal_type->id }}">{{ $meal_type->meal_type }}</option>
            @endforeach
        </select>
        <button type="submit" class="p-3 border border-yellow-600 bg-yellow-600 rounded-full text-white hover:border-yellow-700 hover:bg-yellow-700">Szerkesztés befejezése</button>
    </form>
@endsection