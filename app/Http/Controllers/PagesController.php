<?php

namespace App\Http\Controllers;

use App\Models\RecipeDifficulty;
use App\Models\RecipeMealType;
use Illuminate\Http\Request;


class PagesController extends Controller
{
    public function index() {
        $title = "Főoldal";
        $difficulties = RecipeDifficulty::all();
        $meal_types = RecipeMealType::all();
        return view('pages.index')
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
