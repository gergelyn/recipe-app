<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeInstructions extends Model
{
    use HasFactory;

    protected $fillable = [
        'instruction_text',
        'recipe_id'
    ];

    public function recipe() {
        return $this->belongsTo(Recipe::class);
    }
}
