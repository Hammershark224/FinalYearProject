<?php

namespace App\Http\Controllers;
use App\Models\DishDetail;
use App\Models\MenuDetail;
use Illuminate\Http\Request;

class CalculationController extends Controller
{
    public function index(){
        return view('CalculateMarginProfit.calculatorMenu');
    }

    public function menuPriceCalculator(){
        $dishes = DishDetail::all();
        return view('CalculateMarginProfit.MenuPriceCalculator',['dishes'=>$dishes]);
    }

    public function cashMarginCalculator(){
        return view('CalculateMarginProfit.CashMarginCalculator');
    }

    public function calculateMenuPrice(Request $request){
        $request->validate([
            'dish_cost' => 'required|numeric',
            'target_margin' => 'required|numeric',
        ]);
        // dd($request);
        $dishCost = $request->dish_cost;
        $targetMargin = $request->target_margin;

        // Calculate the cash margin
        $cashMargin = $dishCost * ($targetMargin / 100);

        // Calculate the sell price on the menu
        $sellPrice = $dishCost + $cashMargin;

        // Return the calculated values
        return response()->json([
            'cash_margin' => $cashMargin,
            'sell_price' => $sellPrice
        ]);
    }

    public function storeMenu(Request $request) {
        $request -> validate([
            'sell_price' => 'required|numeric|min:0',
        ]);

        // dd($request);
        MenuDetail::create([
            'dish_ID' => $request->input('dish_ID'),
            'menu_price' => $request->input('sell_price'),
        ]);
        return redirect(route('dish.manage'));
    }

    public function delete(Request $request, $id) {
        $menu = MenuDetail::find($id);
        $menu -> delete();
        return redirect(route('menu.manage'));
    }

    public function calculateMargin(Request $request){
        $request->validate([
            'dish_cost' => 'required|numeric',
            'sell_price' => 'required|numeric',
        ]);
        // dd($request);
        $dishCost = $request->dish_cost;
        $sellPrice = $request->sell_price;

        // Calculate the cash margin
        $cashMargin = $sellPrice - $dishCost;

        // Calculate the sell price on the menu
        $targetMargin = ($cashMargin / $sellPrice) * 100;

        // Return the calculated values
        return response()->json([
            'cash_margin' => $cashMargin,
            'target_margin' => $targetMargin
        ]);
    }
}
