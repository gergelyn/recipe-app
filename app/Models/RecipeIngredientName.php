<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeIngredientName extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_name'
    ];
}
