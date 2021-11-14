<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeCoverImage;
use App\Models\RecipeDifficulty;
use App\Models\RecipeMealType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all();
        $difficulties = RecipeDifficulty::all();
        $meal_types = RecipeMealType::all();
        return view('recipes.index')
            ->with('recipes', $recipes)
            ->with('difficulties', $difficulties)
            ->with('meal_types', $meal_types)
            ->with('title', 'Recipes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $difficulties = RecipeDifficulty::all();
        $meal_types = RecipeMealType::all();
        return view('recipes.create')
            ->with('difficulties', $difficulties)
            ->with('meal_types', $meal_types)
            ->with('title', 'Recept írása');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cook_time' => 'required',
            'difficulty_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meal_type_id' => 'required'
        ]);

        $title = $request->title;
        $image = $request->image;

        $recipe = Recipe::create([
            'title' => $request->title,
            'cook_time' => $request->cook_time,
            'difficulty_id' => $request->difficulty_id,
            'meal_type_id' => $request->meal_type_id,
            'user_id' => auth()->user()->id
        ]);

        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'), $imageName);
        RecipeCoverImage::create([
            'recipe_image_path' => '/images/' . $imageName,
            'recipe_image_caption' => $title,
            'recipe_id' => $recipe->id
        ]);
        return redirect('/recipes')
            ->with('title', 'Recipes')
            ->with('status', 'Sikeres posztolás!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $cover_image = $recipe->cover_image()->where('recipe_id', $recipe->id)->first();
        $difficulty = RecipeDifficulty::find($recipe->difficulty_id)->level;
        $meal_type = RecipeMealType::find($recipe->meal_type_id)->meal_type;
        return view('recipes.show')
            ->with('recipe', $recipe)
            ->with('cover_image', $cover_image)
            ->with('difficulty', $difficulty)
            ->with('meal_type', $meal_type)
            ->with('title', $recipe->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        if(auth()->user()->id !== $recipe->user_id) {
            return redirect('/recipes')->with('status', 'Nem elérhetô');
        }
        $difficulties = RecipeDifficulty::all();
        $meal_types = RecipeMealType::all();
        return view('recipes.edit', compact('recipe'))
            ->with('difficulties', $difficulties)
            ->with('meal_types', $meal_types)
            ->with('title', 'Recept szerkesztése');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'title' => 'required',
            'cook_time' => 'required',
            'difficulty_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meal_type_id' => 'required'
        ]);

        $image = $recipe->cover_image()->where('recipe_id', $recipe->id)->first();

        $recipe->update([
            'title' => $request->title,
            'cook_time' => $request->cook_time,
            'difficulty_id' => $request->difficulty_id,
            'meal_type_id' => $request->meal_type_id
        ]);

        if ($request->hasFile('image')) {
            unlink(public_path().$image->recipe_image_path);
            $newImageReq = $request->image;
            $imageName = time().'.'.$newImageReq->extension();
            $newImageReq->move(public_path('images'), $imageName);
            $image->update([
                'recipe_image_path' => '/images/' . $imageName,
                'recipe_image_caption' => $request->title
            ]);
        }

        return redirect('/recipes')
            ->with('title', 'Recipes')
            ->with('status', 'Sikeres recept szerkesztés!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        if(auth()->user()->id !== $recipe->user_id) {
            return redirect('/recipes')->with('status', 'Nem elérhetô');
        }
        $image = $recipe->cover_image()->where('recipe_id', $recipe->id)->first();
        unlink(public_path().$image->recipe_image_path);
        $image->delete();
        $recipe->delete();
        return redirect('/recipes')
            ->with('title', 'Recipes')
            ->with('status', 'Sikeres recept törlés!');
    }
}

