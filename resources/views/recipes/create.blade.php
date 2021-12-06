@extends('layouts.app')

@section('content')
{{--    <a href="{{ route('recipes.index') }}" class="rounded-full bg-blue-600 text-white px-4 py-2">Vissza</a>--}}
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

    <div class="mx-auto w-1/2">
        <h1 class="text-lg font-bold mb-6 text-yellow-600">Recept posztolása</h1>
        <form action="{{ route('recipes.store') }}" method="POST" class="flex flex-col mt-2" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="image" class="block mb-4">Recept képe</label>
                <input type="file" name="image" id="image" accept="image/*">
            </div>

            <hr class="mb-4">

            <div class="mb-4">
                <label for="title">Recept neve</label>
                <input id="title" type="text" name="title" class="border border-black rounded-full h-10 p-2" value={{ old('title') }}>
            </div>

            <hr class="mb-4">

            <div class="mb-4">
                <label for="cook_time">Elkészítési idő</label>
                <input id="cook_time" type="number" name="cook_time" class="border border-black rounded-full h-10 p-2 w-16 text-center" value={{ old('cook_time') }}> perc
            </div>

            <hr class="mb-4">

            <div class="mb-4">
                <label for="difficulty_id" class="block mb-4">Nehézség</label>
                <select name="difficulty_id" id="difficulty_id" class="border border-black rounded-full h-10 p-2">
                    @foreach ($difficulties as $difficulty)
                        <option value="{{ $difficulty->id }}">{{ Str::title($difficulty->level) }}</option>
                    @endforeach
                </select>
            </div>

            <hr class="mb-4">

            <div class="mb-4">
                <label for="meal_type_id" class="block mb-4">Kategória</label>
                <select name="meal_type_id" id="meal_type_id" class="border border-black rounded-full h-10 p-2">
                    @foreach ($meal_types as $meal_type)
                        <option value="{{ $meal_type->id }}">{{ Str::title($meal_type->meal_type) }}</option>
                    @endforeach
                </select>
            </div>

            <hr class="mb-4">

            <div class="mb-4 ingredients">
                <label for="ingredients">Alapanyagok</label>
                <div class="ingredient my-2">
                    <input type="number" name="measurement_amounts[]" id="measurement_amounts" class="border border-black rounded-full h-10 p-2 w-28 text-center" placeholder="Mennyiség">
                    <select name="unit_type_ids[]" id="unit_type_ids" class="border border-black rounded-full h-10 p-2 text-center">
                        @foreach ($unit_types as $unit_type)
                            <option value="{{ $unit_type->id }}">{{ $unit_type->unit_type }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="ingredient_names[]" id="ingredient_names" class="border border-black rounded-full h-10 p-2" placeholder="Alapanyag">
                </div>
            </div>

            <div class="mb-6">
                <a id="plus-ingredient" class="w-full border border-yellow-600 rounded-full p-3 cursor-pointer bg-yellow-600 hover:border-yellow-700 hover:bg-yellow-700 text-white">Új hozzávaló+</a>
            </div>

            <hr class="mb-4">

            <div class="mb-4 instructions">
                <label for="instructions">Elkészítés</label>
                <div class="instruction my-2">
                    <input type="text" name="instructions[]" id="instruction" class="border border-black rounded-full h-10 p-2" placeholder="Teendő">
                </div>
            </div>

            <div class="mb-4">
                <a id="plus-instruction" class="w-full border border-yellow-600 rounded-full p-3 cursor-pointer bg-yellow-600 hover:border-yellow-700 hover:bg-yellow-700 text-white">Új lépés+</a>
            </div>

            <button type="submit" class="m-auto p-3 border border-yellow-600 bg-yellow-600 rounded-full text-white hover:border-yellow-700 hover:bg-yellow-700 mt-2">Posztolás</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        let plusIngredientBtn = document.querySelector("#plus-ingredient");
        let ingredientsContainer = document.querySelector(".ingredients");

        let plusInstructionBtn = document.querySelector("#plus-instruction");
        let instructionsContainer = document.querySelector(".instructions");

        plusIngredientBtn.addEventListener("click", function() {
            let unitTypes = [
                @foreach($unit_types as $unit_type)
                    ["{{ $unit_type->id }}", "{{ $unit_type->unit_type }}"],
                @endforeach
            ];
            let ingredientContainer = document.createElement("div");
            ingredientContainer.setAttribute("class", "ingredient my-2")
            let unitTypeIdSelect = document.createElement("select");
            unitTypeIdSelect.setAttribute("id", "unit_type_ids");
            unitTypeIdSelect.setAttribute("class", "border border-black rounded-full h-10 p-2 text-center");
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
            measurementAmountInput.setAttribute("class", "border border-black rounded-full h-10 p-2 w-28 text-center");
            measurementAmountInput.setAttribute("id", "measurement_amounts");
            measurementAmountInput.setAttribute("placeholder", "Mennyiség");

            let ingredientNameInput = document.createElement("input");
            ingredientNameInput.setAttribute("type", "text");
            ingredientNameInput.setAttribute("name", "ingredient_names[]");
            ingredientNameInput.setAttribute("class", "border border-black rounded-full h-10 p-2");
            ingredientNameInput.setAttribute("id", "ingredient_names");
            ingredientNameInput.setAttribute("placeholder", "Alapanyag");

            ingredientContainer.appendChild(measurementAmountInput);
            ingredientContainer.appendChild(unitTypeIdSelect);
            ingredientContainer.appendChild(ingredientNameInput);
            ingredientsContainer.appendChild(ingredientContainer);
        });

        plusInstructionBtn.addEventListener("click", function() {
            let instructionContainer = document.createElement("div");
            instructionContainer.setAttribute("class", "instruction my-2");
            let instructionInput = document.createElement("input");
            instructionInput.setAttribute("type", "text");
            instructionInput.setAttribute("name", "instructions[]");
            instructionInput.setAttribute("class", "border border-black rounded-full h-10 p-2");
            instructionInput.setAttribute("placeholder", "Teendő");
            instructionContainer.appendChild(instructionInput);
            instructionsContainer.appendChild(instructionContainer);
        });
    </script>
@endsection
