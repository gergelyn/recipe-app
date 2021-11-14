<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(rand(1, 3)),
            'cook_time' => rand(5, 60),
            'difficulty_id' => rand(1, 3),
            'meal_type_id' => rand(1, 3)
        ];
    }
}
