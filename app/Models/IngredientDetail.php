<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientDetail extends Model
{
    use HasFactory;

    protected $primaryKey = "ingredient_ID";
    protected $fillable = ['ingredient_name','ingredient_price'];

    // public function recipe()
    // {
    //     return $this->hasOne(RecipeDetail::class);
    // }

    public function dishes() {
        return $this->belongsToMany(DishDetail::class, 'recipe_details', 'ingredient_ID', 'dish_ID');
    }
    
}
