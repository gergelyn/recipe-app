<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeCoverImage;
use App\Models\RecipeDifficulty;
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
        $recipes = DB::table('recipes')
                    ->join('recipe_difficulties', 'recipes.difficulty_id', '=', 'recipe_difficulties.id')
                    ->join('recipe_cover_images', 'recipes.id', '=', 'recipe_cover_images.recipe_id')
                    ->select('recipes.*', 'recipe_difficulties.level', 'recipe_cover_images.recipe_image_path', 'recipe_cover_images.recipe_image_caption')
                    ->paginate(9);
        return view('recipes.index')
            ->with('recipes', $recipes)
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
        return view('recipes.create')
            ->with('difficulties', $difficulties)
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $title = $request->title;
        $image = $request->image;

        $recipe = Recipe::create([
            'title' => $request->title,
            'cook_time' => $request->cook_time,
            'difficulty_id' => $request->difficulty_id
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
            ->with('success', 'Sikeres posztolás!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $recipe = DB::table('recipes')
                ->join('recipe_difficulties', 'recipes.difficulty_id', '=', 'recipe_difficulties.id')
                ->join('recipe_cover_images', 'recipes.id', '=', 'recipe_cover_images.recipe_id')
                ->select('recipes.*', 'recipe_difficulties.level', 'recipe_cover_images.recipe_image_path', 'recipe_cover_images.recipe_image_caption')
                ->where('recipes.id', '=', $recipe->id)
                ->first();
        return view('recipes.show')
            ->with('recipe', $recipe)
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
        $difficulties = RecipeDifficulty::all();
        return view('recipes.edit', compact('recipe'))
            ->with('difficulties', $difficulties)
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $image = $recipe->cover_image()->where('recipe_id', $recipe->id)->first();

        $recipe->update([
            'title' => $request->title,
            'cook_time' => $request->cook_time,
            'difficulty_id' => $request->difficulty_id
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
            ->with('success', 'Sikeres recept szerkesztés!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $image = $recipe->cover_image()->where('recipe_id', $recipe->id)->first();
        unlink(public_path().$image->recipe_image_path);
        $image->delete();
        $recipe->delete();
        return redirect('/recipes')
            ->with('title', 'Recipes')
            ->with('success', 'Sikeres recept törlés!');
    }
}

