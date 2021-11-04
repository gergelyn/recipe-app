<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
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
