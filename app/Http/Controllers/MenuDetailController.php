<?php

namespace App\Http\Controllers;

use App\Models\DishDetail;
use Illuminate\Http\Request;

class MenuDetailController extends Controller
{
    public function index() {
        $dishes = DishDetail::all();
        return view('ManageMenu.menuManage',['dishes'=>$dishes]);
    }

    public function indexRecipe() {
        $dishes = DishDetail::all();
        return view('ManageMenu.recipeManage',['dishes'=>$dishes]);
    }
}
