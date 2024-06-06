<?php

namespace App\Http\Controllers;

use App\Models\CompanyDetail;
use App\Models\IngredientDetail;
use App\Models\SupplierDetail;
use Illuminate\Http\Request;

class PriceComparisonController extends Controller
{
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
