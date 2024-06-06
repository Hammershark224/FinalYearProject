<?php

namespace App\Http\Controllers;

use App\Models\CostDetail;
use App\Models\DishDetail;
use App\Models\MenuDetail;
use App\Models\PriceDetail;
use Illuminate\Http\Request;

class CostDetailController extends Controller
{
    // public function index() {
    //     $costSetting = CostDetail::firstOrCreate([], [
    //         'overhead_cost' => 0,
    //         'labor_cost' => 0,
    //         'margin_cost' => 0,
    //     ]);
    //     return view('ManageMenuPrice.costSetting', compact('costSetting'));
    // }

    public function index() {
        $costs = CostDetail::all();
        return view('ManageIndirectCost.costManage', compact('costs'));
    }

    
    public function create() {
        return view('ManageIndirectCost.addCost');
    }

    public function store(Request $request) {
        $request->validate([
            'cost_type' => 'required|string',
            'value' => 'required|numeric',
        ]);

        $costSetting = CostDetail::create([
            'cost_type' => $request->input('cost_type'),
            'value' => $request->input('value'),
        ]);
        return redirect(route('cost.manage'));
    }

    public function edit($id) {
        $cost = CostDetail::findOrFail($id);
        return view('ManageIndirectCost.editCost', compact('cost'));
    }

    public function update(Request $request, $id) {
        $costs = CostDetail::findOrFail($id);
        $request->validate([
            'cost_type' => 'required|string',
            'value' => 'required|numeric',
        ]);

        $costSetting = CostDetail::create([
            'cost_type' => $request->input('cost_type'),
            'value' => $request->input('value'),
        ]);
    }

    public function deleteIngredient($id) {
        $dataIngredient = CostDetail::find($id);
        $dataIngredient -> delete();
        return redirect(route('cost.manage'));
    }

    // public function store(Request $request) {
    //     $request->validate([
    //         'overhead_cost' => 'required|numeric',
    //         'labor_cost' => 'required|numeric',
    //         'margin_cost' => 'required|numeric',
    //     ]);
    //     $costSetting = CostDetail::firstOrCreate([]);
        
    //     // Update the cost settings
    //     $costSetting->update([
    //         'overhead_cost' => $request->input('overhead_cost'),
    //         'labor_cost' => $request->input('labor_cost'),
    //         'margin_cost' => $request->input('margin_cost'),
    //     ]);
    
    //     // Redirect back with a success message
    //     return redirect()->route('cost.setting')->with('success', 'Cost settings updated successfully.');
    // }

    // public function settingPrice() {
    //     $dishes = DishDetail::all();
    //     $costSetting = CostDetail::first();
    //     // dd($costSetting);
    //     return view('ManageMenuPrice.priceSetting', compact('dishes', 'costSetting'));
    // }

    
    
    
    
    

    
    
    

    // public function calculatePrice(Request $request)
    // {
    //     $dishCost = $request->input('dish_cost');
    //     $laborCostPerHour = $request->input('labor_cost_per_hour');
    //     $laborTime = $request->input('labor_time');
    //     $overheadCost = $request->input('overhead_cost');
    //     $profitMargin = $request->input('profit_margin');
    
    //     // Calculate the total labor cost
    //     $totalLaborCost = ($laborCostPerHour / 60) * $laborTime;
    
    //     // Calculate the total cost
    //     $totalCost = $dishCost + $totalLaborCost + $overheadCost;
    
    //     // Calculate the desired profit
    //     $desiredProfit = ($totalCost * $profitMargin) / 100;
    
    //     // Calculate the menu price
    //     $menuPrice = $totalCost + $desiredProfit;
    
    //     // Return the result as JSON
    //     return response()->json(['menu_price' => number_format($menuPrice, 2)]);
    // }
    
}
