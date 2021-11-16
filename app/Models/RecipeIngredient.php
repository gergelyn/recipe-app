<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'recipe_id',
        'measurement_unit_id',
        'measurement_qty_id',
        'ingredient_name_id'
    ];

    public function recipe() {
        return $this->belongsTo(Recipe::class, 'recipe_id', 'id');
    }

    public function measurement_unit() {
        return $this->hasOne(RecipeIngredientUnitType::class, 'id', 'measurement_unit_id');
    }

    public function measurement_qty() {
        return $this->hasOne(RecipeIngredientMeasurementQty::class, 'id', 'measurement_qty_id');
    }

    public function ingredient_name() {
        return $this->hasOne(RecipeIngredientName::class, 'id', 'ingredient_name_id');
    }
}
