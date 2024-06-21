<?php

namespace App\Http\Controllers;

use App\Models\CompanyDetail;
use App\Models\DishDetail;
use App\Models\IngredientDetail;
use App\Models\MenuDetail;
use Illuminate\Support\Facades\Storage;
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
        $dataDish = DishDetail::all();
        $menus = MenuDetail::all();
        $photoUrls = [];
    
        foreach ($dataDish as $dish) {
            if ($dish->dish_photo) {
                // Generate URL for the dish photo
                $photoUrls[$dish->dish_ID] = Storage::url('dish_photos/' . $dish->dish_photo);
            }
        }
        $datas = [
            'ingredients' => $ingredients,
            'dishes' => $dishes,
            'suppliers' => $suppliers,
        ];
    
        return view('ManageUser.dashboard', compact('datas', 'menus', 'photoUrls'));
    }
    
    public function showCurrentTime()
    {
        $currentTime = Carbon::now();
        // dd($currentTime);
        return view('layouts.navbars.auth.topnav',  ['currentTime' => $currentTime]);
    }
}
