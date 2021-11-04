<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $title = "Főoldal";
    return view('layouts.app')->with('title', $title);
});

Route::get('/impresszum', [PagesController::class, 'impresszum']);
Route::get('/adatvedelem', [PagesController::class, 'adatvedelem']);
Route::get('/suti-beallitasok', [PagesController::class, 'suti']);
Route::get('/felhasznalasi-feltetelek', [PagesController::class, 'felhasznalasi_feltetelek']);

Route::resource('posts', PostController::class);
