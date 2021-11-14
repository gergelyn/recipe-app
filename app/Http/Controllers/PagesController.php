<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeDifficulty;
use App\Models\RecipeMealType;
use Illuminate\Http\Request;


class PagesController extends Controller
{
    public function index() {
        $title = "Főoldal";
        $soup = Recipe::where('meal_type_id', 1)
            ->orderBy('created_at', 'desc')
            ->first();
        $main_course = Recipe::where('meal_type_id', 2)
            ->orderBy('created_at', 'desc')
            ->first();
        $dessert = Recipe::where('meal_type_id', 3)
            ->orderBy('created_at', 'desc')
            ->first();
        $difficulties = RecipeDifficulty::all();
        $meal_types = RecipeMealType::all();
        return view('pages.index')
            ->with('soup', $soup)
            ->with('main_course', $main_course)
            ->with('dessert', $dessert)
            ->with('difficulties', $difficulties)
            ->with('meal_types', $meal_types)
            ->with('title', $title);
    }

    public function impresszum() {
        $title = "Impresszum";
        return view('pages.impresszum')->with('title', $title);
    }

    public function adatvedelem() {
        $title = "Adatvédelem";
        return view('pages.adatvedelem')->with('title', $title);
    }

    public function suti() {
        $title = "Süti beállítások";
        return view('pages.suti')->with('title', $title);
    }

    public function felhasznalasi_feltetelek() {
        $title = "Felhasználási feltételek";
        return view('pages.felhasznalasif')->with('title', $title);
    }
}
