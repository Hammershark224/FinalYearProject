<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CostDetailController extends Controller
{
    public function index() {
        return view('ManageMenuPrice.price');
    }
}
