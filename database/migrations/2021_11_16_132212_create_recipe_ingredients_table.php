<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')
                ->constrained('recipes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('measurement_unit_id')
                ->constrained('recipe_ingredient_unit_types')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('measurement_qty_id')
                ->constrained('recipe_ingredient_measurement_qties')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('ingredient_name_id')
                ->constrained('recipe_ingredient_names')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_ingredients');
    }
}
