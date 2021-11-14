<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SearchController;

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


Route::get('/', [PagesController::class, 'index']);
Route::get('/impresszum', [PagesController::class, 'impresszum']);
Route::get('/adatvedelem', [PagesController::class, 'adatvedelem']);
Route::get('/suti-beallitasok', [PagesController::class, 'suti']);
Route::get('/felhasznalasi-feltetelek', [PagesController::class, 'felhasznalasi_feltetelek']);

Route::resource('posts', PostController::class);
Route::resource('recipes', RecipeController::class);

Route::get('/search', SearchController::class);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
