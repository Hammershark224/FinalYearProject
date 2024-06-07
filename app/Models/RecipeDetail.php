<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeDetail extends Model
{
    use HasFactory;

    protected $primaryKey = ['dish_ID', 'ingredient_ID'];
    protected $fillable = ['ingredient_ID', 'dish_ID', 'recipe_weight'];
    public $incrementing = false;

    public function dish() {
        return $this->belongsTo(DishDetail::class, 'dish_ID');
    }

    // Define the relationship with IngredientDetail
    public function ingredient() {
        return $this->belongsTo(IngredientDetail::class, 'ingredient_ID');
    }
}
