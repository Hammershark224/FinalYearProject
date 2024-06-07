<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientDetail extends Model
{
    use HasFactory;

    protected $primaryKey = "ingredient_ID";
    protected $fillable = [
        'ingredient_name',
        'ingredient_weight',
        'ingredient_photo',
    ];

    // public function recipe()
    // {
    //     return $this->hasOne(RecipeDetail::class);
    // }

    public function dishes() {
        return $this->hasManyThrough(
            DishDetail::class,
            RecipeDetail::class,
            'ingredient_ID', // Foreign key on RecipeDetail table...
            'dish_ID', // Foreign key on DishDetail table...
            'ingredient_ID', // Local key on IngredientDetail table...
            'dish_ID' // Local key on RecipeDetail table...
        );
    }

    public function recipes() {
        return $this->hasMany(RecipeDetail::class, 'ingredient_ID');
    }
    
    public function suppliers() {
        return $this->hasMany(SupplierDetail::class, 'ingredient_ID');
    }
 
    public function lowestPrice()
    {
        return $this->hasOne(SupplierDetail::class, 'ingredient_ID','ingredient_ID')->orderBy('ingredient_price', 'asc')->limit(1);
    }
}
