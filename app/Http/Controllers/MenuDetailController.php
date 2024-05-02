<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\DishDetail;
use App\Models\MenuDetail;
use Illuminate\Http\Request;

class MenuDetailController extends Controller
{
    public function index() {
        $dishes = DishDetail::all();
        $photoUrls = [];
    
        foreach ($dishes as $dish) {
            if ($dish->dish_photo) {
                // Generate URL for the dish photo
                $photoUrls[$dish->dish_ID] = Storage::url('dish_photos/' . $dish->dish_photo);
            }
        }
    // dd($photoUrls);
        return view('ManageMenu.menu', ['dishes' => $dishes, 'photoUrls' => $photoUrls]);
    }

    public function menuTable() {
        // $menus = MenuDetail::paginate(10); // Paginate with 10 items per page, adjust as needed
        $menus = MenuDetail::with('dish')->get();
        return view('ManageMenu.menuManage', ['menus' => $menus]);
    }

    public function createMenu() {
        return view('ManageMenu.addRecipe');
    }
    
    public function updateStatus(Request $request, $id) 
    {
        // Find the dish by its ID
        $dish = DishDetail::find($id);
        $dish -> update($request->all());

        return redirect(route('menu.manage'));
    }

    
}
