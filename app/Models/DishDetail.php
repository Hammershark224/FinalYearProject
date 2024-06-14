<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'dish_ID';
    protected $fillable = [
        'dish_name',
        'dish_description',
        'dish_cost',
        'dish_status',
        'dish_photo'
    ];

    // public function recipe()
    // {
    //     return $this->hasOne(RecipeDetail::class);
    // }
    
    public function recipeDetails() {
        return $this->hasMany(RecipeDetail::class);
    }

    public function recipes() {
        return $this->hasMany(RecipeDetail::class, 'dish_ID');
    }
    
    public function ingredients() {
        return $this->hasManyThrough(
            IngredientDetail::class,
            RecipeDetail::class,
            'dish_ID',
            'ingredient_ID',
            'dish_ID',
            'ingredient_ID'
        );
    }

    public function menu() {
        return $this->hasOne(MenuDetail::class);
    }

    public function priceDetails() {
        return $this->hasMany(PriceDetail::class, 'dish_ID');
    }
    
}
