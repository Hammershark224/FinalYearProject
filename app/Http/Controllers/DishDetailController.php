<?php

namespace App\Http\Controllers;

use App\Models\DishDetail;
use App\Models\IngredientDetail;
use Illuminate\Http\Request;

class DishDetailController extends Controller
{
    public function index() {
        $dishes = DishDetail::all();
        return view('ManageDish.dishManage',['dishes'=>$dishes]);
    }

    public function create() {
        IngredientDetail::all();
        $ingredients = IngredientDetail::all();
        return view('ManageDish.addDish',['ingredients' => $ingredients]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'dish_name' => 'required|string',
            'dish_description' => 'required|string',
            'dish_cost' => 'required|float',
        ]);
        DishDetail::create($request);
        return redirect(route('dish.manage'));
    }
}
