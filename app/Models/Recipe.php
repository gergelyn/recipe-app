<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'cook_time',
        'difficulty_id',
        'meal_type_id'
    ];

    public function difficulty() {
        return $this->hasOne(RecipeDifficulty::class);
    }

    public function cover_image() {
        return $this->hasOne(RecipeCoverImage::class);
    }

    public function meal_type() {
        return $this->hasOne(RecipeMealType::class);
    }
}
