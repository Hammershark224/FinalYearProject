<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculationController extends Controller
{
    public function index(){
        return view('CalculateMarginProfit.calculatorMenu');
    }

    public function menuPriceCalculator(){
        return view('CalculateMarginProfit.MenuPriceCalculator');
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
