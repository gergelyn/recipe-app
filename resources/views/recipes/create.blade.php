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
            <input id="title" type="text" name="title" class="border-2 border-black rounded-md" value={{ old('title') }}>
        </div>
        
        <div class="mb-4">
            <label for="cook_time">Idô</label>
            <input id="cook_time" type="number" name="cook_time" class="border-2 border-black rounded-md" value={{ old('cook_time') }}>
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

        <div class="mb-4 ingredients">
            <label for="ingredients">Alapanyagok</label>
            <div class="ingredient my-2">
                <select name="unit_type_ids[]" id="unit_type_ids" class="border-2 border-black rounded-md">
                    @foreach ($unit_types as $unit_type)
                        <option value="{{ $unit_type->id }}">{{ $unit_type->unit_type }}</option>
                    @endforeach
                </select>
                <input type="number" name="measurement_amounts[]" id="measurement_amounts" class="border-2 border-black rounded-md" placeholder="Mennyiség">
                <input type="text" name="ingredient_names[]" id="ingredient_names" class="border-2 border-black rounded-md" placeholder="Alapanyag">
            </div>
        </div>

        <div class="mb-4">
            <a id="plus-ingredient" class="w-full border border-blue-600 p-3 cursor-pointer bg-blue-600 hover:border-blue-700 hover:bg-blue-700 text-white">+</a>
        </div>
        
        <button type="submit" class="p-3 border border-yellow-600 bg-yellow-600 rounded-full text-white hover:border-yellow-700 hover:bg-yellow-700 mt-2">Posztolás</button>
    </form>
@endsection

@section('script')
    <script>
        let plusBtn = document.querySelector("#plus-ingredient");
        let ingredientsContainer = document.querySelector(".ingredients");

        plusBtn.addEventListener("click", function() {
            let unitTypes = [
                @foreach($unit_types as $unit_type)
                    ["{{ $unit_type->id }}", "{{ $unit_type->unit_type }}"],
                @endforeach
            ];
            let ingredientContainer = document.createElement("div");
            ingredientContainer.setAttribute("class", "ingredient my-2")
            let unitTypeIdSelect = document.createElement("select");
            unitTypeIdSelect.setAttribute("id", "unit_type_ids");
            unitTypeIdSelect.setAttribute("class", "border-2 border-black rounded-md");
            unitTypeIdSelect.setAttribute("name", "unit_type_ids[]");

            for(let i = 0; i<unitTypes.length; i++) {
                let unitTypeOption = document.createElement("option");
                unitTypeOption.setAttribute("value", unitTypes[i][0]);
                unitTypeOption.innerText = unitTypes[i][1];
                unitTypeIdSelect.appendChild(unitTypeOption);
            }

            let measurementAmountInput = document.createElement("input");
            measurementAmountInput.setAttribute("type", "number");
            measurementAmountInput.setAttribute("name", "measurement_amounts[]");
            measurementAmountInput.setAttribute("class", "border-2 border-black rounded-md");
            measurementAmountInput.setAttribute("id", "measurement_amounts");
            measurementAmountInput.setAttribute("placeholder", "Mennyiség");

            let ingredientNameInput = document.createElement("input");
            ingredientNameInput.setAttribute("type", "text");
            ingredientNameInput.setAttribute("name", "ingredient_names[]");
            ingredientNameInput.setAttribute("class", "border-2 border-black rounded-md");
            ingredientNameInput.setAttribute("id", "ingredient_names");
            ingredientNameInput.setAttribute("placeholder", "Alapanyag");

            ingredientContainer.appendChild(unitTypeIdSelect);
            ingredientContainer.appendChild(measurementAmountInput);
            ingredientContainer.appendChild(ingredientNameInput);
            ingredientsContainer.appendChild(ingredientContainer);
        });
    </script>
@endsection