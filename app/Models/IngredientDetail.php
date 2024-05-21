<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientDetail extends Model
{
    use HasFactory;

    protected $primaryKey = "ingredient_ID";
    protected $fillable = ['ingredient_name','ingredient_weight'];

    // public function recipe()
    // {
    //     return $this->hasOne(RecipeDetail::class);
    // }

    public function dishes() {
        return $this->belongsToMany(DishDetail::class, 'recipe_details', 'ingredient_ID', 'dish_ID');
    }
    
    public function suppliers() {
        return $this->hasMany(SupplierDetail::class, 'ingredient_ID');
    }
 
    public function lowestPrice()
    {
        return $this->hasOne(SupplierDetail::class, 'ingredient_ID','ingredient_ID')->orderBy('ingredient_price', 'asc')->limit(1);
    }
}
