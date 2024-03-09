<?php

namespace App\Http\Controllers;

use App\Models\DishDetail;
use Illuminate\Http\Request;

class DishDetailController extends Controller
{
    public function index() {
        $dishes = DishDetail::all();
        return view('ManageDish.dishManage',['dishes'=>$dishes]);
    }
}
