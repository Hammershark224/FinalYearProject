<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\DishDetail;
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
        return view('ManageMenu.menuManage', ['dishes' => $dishes, 'photoUrls' => $photoUrls]);
    }

    public function updateStatus(Request $request, $id) 
    {
        // Find the dish by its ID
        $dish = DishDetail::find($id);
        $dish -> update($request->all());

        return redirect(route('menu.manage'));
    }

    
}
