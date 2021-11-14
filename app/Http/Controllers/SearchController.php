<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeDifficulty;
use App\Models\RecipeMealType;

class SearchController extends Controller
{
    public function __invoke(Request $request) {
        $recipes = null;
        $difficulties = RecipeDifficulty::all();
        $meal_types = RecipeMealType::all();

        if ($query = $request->get('query')) {
            $recipes = Recipe::search($query)
                ->get();
        }

        return view('recipes.index')
            ->with('recipes', $recipes)
            ->with('difficulties', $difficulties)
            ->with('meal_types', $meal_types)
            ->with('title', 'Receptek');
    }
}
