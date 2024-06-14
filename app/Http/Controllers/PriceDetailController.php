<?php

namespace App\Http\Controllers;

use App\Models\CostDetail;
use App\Models\DishDetail;
use App\Models\MenuDetail;
use App\Models\PriceDetail;
use Illuminate\Http\Request;

class PriceDetailController extends Controller
{
    public function settingPrice() {
        $dishes = DishDetail::all();
        $costSetting = CostDetail::all();
        // dd($costSetting);
        return view('ManageMenuPrice.priceSetting', compact('dishes', 'costSetting'));
    }

    public function storeMenuPrice(Request $request) {
        // Validate the request data
        $request->validate([
            'menu_price' => 'required|numeric|min:0',
            'dish_ID' => 'required|exists:dish_details,dish_ID', // Validate if the dish ID exists in the 'dish_details' table
            'priceDetail.*' => 'nullable|numeric|min:0', // Validate each price detail as numeric and non-negative
        ]);
    
        // Save menu price to MenuDetail model
        $menuPrice = MenuDetail::create([
            'dish_ID' => $request->input('dish_ID'),
            'menu_price' => $request->input('menu_price'),
        ]);
    
        // Extract dish ID and price details from the request
        $dishID = $request->input('dish_ID');
        $priceDetails = $request->input('priceDetail', []);
    
        foreach ($priceDetails as $costType => $priceValue) {
            // Save price detail
            PriceDetail::create([
                'dish_ID' => $dishID,
                'price_type' => $costType, // Assuming costID corresponds to price_type
                'value' => $priceValue,
            ]);
        }
    
        // Redirect with success message
        return redirect(route('menu.manage'))->with('success', 'Menu price and details saved successfully');
    }    
}
