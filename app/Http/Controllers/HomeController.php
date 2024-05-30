<?php

namespace App\Http\Controllers;

use App\Models\CompanyDetail;
use App\Models\DishDetail;
use App\Models\IngredientDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // dd('aaaa');
        $ingredients = IngredientDetail::all()->count();
        $dishes = DishDetail::all()->count();
        $suppliers = CompanyDetail::all()->count();
        $datas = [
            'ingredients' => $ingredients,
            'dishes' => $dishes,
            'suppliers' => $suppliers,
        ];
    
        return view('ManageUser.dashboard', compact('datas'));
    }
    
    // public function showCurrentTime()
    // {
    //     $currentTime = Carbon::now();
    //     // dd($currentTime);
    //     return view('layouts.navbars.auth.topnav', compact('currentTime'));
    // }
}
