<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function impresszum() {
        $title = "Best-Recipes | Impresszum";
        return view('pages.impresszum')->with('title', $title);
    }

    public function adatvedelem() {
        $title = "Best-Recipes | Adatvédelem";
        return view('pages.adatvedelem')->with('title', $title);
    }

    public function suti() {
        $title = "Best-Recipes | Süti beállítások";
        return view('pages.suti')->with('title', $title);
    }

    public function felhasznalasi_feltetelek() {
        $title = "Best-Recipes | Felhasználási feltételek";
        return view('pages.felhasznalasif')->with('title', $title);
    }
}
