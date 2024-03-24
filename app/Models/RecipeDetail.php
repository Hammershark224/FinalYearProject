<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeDetail extends Model
{
    use HasFactory;

    protected $fillable = ['ingredient_ID', 'dish_ID'];
    protected $primaryKey = ['dish_ID', 'ingredient_ID'];
    public $incrementing = false;

    public function ingredient()
    {
        return $this->belongsTo(IngredientDetail::class, 'ingredient_ID', 'ingredient_ID');
    }

    public function dish()
    {
        return $this->belongsTo(DishDetail::class, 'dish_ID', 'dish_ID');
    }
}
