<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Recipe extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'cook_time',
        'difficulty_id',
        'meal_type_id',
        'user_id'
    ];

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function difficulty() {
        return $this->hasOne(RecipeDifficulty::class);
    }

    public function cover_image() {
        return $this->hasOne(RecipeCoverImage::class);
    }

    public function meal_type() {
        return $this->hasOne(RecipeMealType::class);
    }

    public function ingredients() {
        return $this->hasMany(RecipeIngredient::class);
    }

    public function instructions() {
        return $this->hasMany(RecipeInstructions::class);
    }
}
