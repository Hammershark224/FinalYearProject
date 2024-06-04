<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\IngredientDetail;
use App\Models\SupplierDetail;
use App\Models\CompanyDetail;
use Illuminate\Http\Request;
use App\Imports\IngredientsImport;
use App\Exports\IngredientsExport;

class IngredientDetailController extends Controller
{
    public function index() {
        $ingredients = IngredientDetail::all();
        return view('ManageIngredient.ingredient', compact('ingredients'));
    }

    public function export() {
        return Excel::download(new IngredientsExport, 'ingredients_list.xlsx');
    }

    public function createIngredient() {
        return view('ManageIngredient.addIngredient');
    }

    public function storeIngredient(Request $request) {
        $request->validate([
            'ingredient_name' => 'required|string',
            'ingredient_weight' => 'required|numeric',
        ]);

        $company = IngredientDetail::create([
            'ingredient_name' => $request->input('ingredient_name'),
            'ingredient_weight' => $request->input('ingredient_weight'),
        ]);

        return redirect(route('ingredient'));
    }

    public function editIngredient($ingredient_name) {
        $ingredient = IngredientDetail::where('ingredient_name', $ingredient_name)->firstOrFail();
        return view('ManageIngredient.editIngredient', compact('ingredient'));
    }

    public function updateIngredient(Request $request, $id) {
        $request->validate([
            'ingredient_name' => 'required|string',
            'ingredient_weight' => 'required|numeric',
        ]);
        $ingredient = IngredientDetail::findOrFail($id);
        $ingredient->update([
            'ingredient_name' => $request->input('ingredient_name'),
            'ingredient_weight' => $request->input('ingredient_weight'),
        ]);

        return redirect(route('ingredient'));
    }

    public function deleteIngredient($id) {
        $dataIngredient = IngredientDetail::find($id);
        $dataIngredient -> delete();
        return redirect(route('ingredient'));
    }

    public function ingredient_index() {

        $companies = CompanyDetail::all();
        $suppliers = SupplierDetail::all();
        
        $ingredients = IngredientDetail::with('suppliers')->get();
        
        // Loop through each ingredient to calculate highest and lowest prices
        foreach ($ingredients as $ingredient) {
            $supplierPrices = [];
    
            // Collect all supplier prices for this ingredient
            foreach ($ingredient->suppliers as $supplier) {
                $supplierPrices[] = $supplier->ingredient_price;
            }
    
            // Calculate highest and lowest prices if supplierPrices is not empty
            if (!empty($supplierPrices)) {
                $ingredient->highest_price = max($supplierPrices);
                $ingredient->lowest_price = min($supplierPrices);
            } else {
                // Set default values if no supplier prices found
                $ingredient->highest_price = 0; // Or any other default value
                $ingredient->lowest_price = 0; // Or any other default value
            }
        }
        
        return view('ManageIngredient.ingredientManage', compact('ingredients', 'suppliers', 'companies'));
    }

}
