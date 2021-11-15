@extends('layouts.app')

@section('content')
    <h1 class="text-lg font-bold">Recept posztolása</h1>
    <a href="{{ route('recipes.index') }}" class="rounded-full bg-blue-600 text-white px-4 py-2">Vissza</a>
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

    <form action="{{ route('recipes.store') }}" method="POST" class="flex flex-col w-1/2 mt-2" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="image">Recept képe</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>
        
        <div class="mb-4">
            <label for="title">Cím</label>
            <input id="title" type="text" name="title" class="border-2 border-black rounded-md">
        </div>
        
        <div class="mb-4">
            <label for="cook_time">Idô</label>
            <input id="cook_time" type="number" name="cook_time" class="border-2 border-black rounded-md">
        </div>

        <div class="mb-4">
            <label for="difficulty_id">Nehézség</label>
            <select name="difficulty_id" id="difficulty_id" class="border-2 border-black rounded-md">
                @foreach ($difficulties as $difficulty)
                    <option value="{{ $difficulty->id }}">{{ Str::title($difficulty->level) }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-4">
            <label for="meal_type_id">Típus</label>
            <select name="meal_type_id" id="meal_type_id" class="border-2 border-black rounded-md">
                @foreach ($meal_types as $meal_type)
                    <option value="{{ $meal_type->id }}">{{ Str::title($meal_type->meal_type) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="ingredients">Alapanyagok</label>
            <select name="unit_type" id="unit_type" class="border-2 border-black rounded-md">
                
            </select>
            <input type="number" name="measurement_amount" id="measurement_amount" class="border-2 border-black rounded-md" placeholder="Mennyiség">
            <input type="text" name="ingredient_name" id="ingredient_name" class="border-2 border-black rounded-md" placeholder="Alapanyag">
        </div>
        
        <button type="submit" class="p-3 border border-yellow-600 bg-yellow-600 rounded-full text-white hover:border-yellow-700 hover:bg-yellow-700 mt-2">Posztolás</button>
    </form>
@endsection