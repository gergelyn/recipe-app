<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeCoverImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'recipe_image_path',
        'recipe_image_caption'
    ];

    public function recipe() {
        return $this->belongsTo(Recipe::class);
    }
}
