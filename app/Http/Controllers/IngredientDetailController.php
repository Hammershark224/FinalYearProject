<?php

namespace App\Http\Controllers;

use App\Models\IngredientDetail;
use Illuminate\Http\Request;

class IngredientDetailController extends Controller
{
    public function index() {
        $ingredients = IngredientDetail::all();
        return view('ManageIngredient.ingredientManage',['ingredients'=>$ingredients]);
    }
}
