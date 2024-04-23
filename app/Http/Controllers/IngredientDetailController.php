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
        return Excel::download(new IngredientsExport, 'ingredient_lists.xlsx');
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

    public function deleteIngredient($id) {
        $dataIngredient = IngredientDetail::find($id);
        $dataIngredient -> delete();
        return redirect(route('ingredient'));
    }

    public function company_index() {
        $companies = CompanyDetail::all();
        return view('ManageIngredient.companyManage', compact('companies'));
    }

    public function ingredient_index() {
        // Fetch all companies
        $companies = CompanyDetail::all();
        
        // Fetch all suppliers
        $suppliers = SupplierDetail::all();
        
        // Fetch all ingredients with their associated suppliers
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
        
        // Pass ingredients, suppliers, and companies data to the view
        return view('ManageIngredient.ingredientManage', compact('ingredients', 'suppliers', 'companies'));
    }
    

    public function createSupplier() {
        return view('ManageIngredient.addSupplier');
    }

    public function upload_excel_file(Request $request)
    {
        $request->validate([
            'ingredients_list' => 'required|file|mimes:xlsx,xls'
        ]);
    
        $request->validate([
            'company_name' => 'required|string',
            'company_address' => 'required|string',
        ]);
    
        // Create a new company
        $company = CompanyDetail::create([
            'company_name' => $request->input('company_name'),
            'company_address' => $request->input('company_address'),
        ]);
    
        // Debug: Check the company data
     
    
        // Get the company_ID
        $companyId = $company->company_ID;
    
        // Debug: Check the company ID

    
        // Upload and import the Excel file
        $file = $request->file('ingredients_list');
        $filePath = $file->storeAs('excel', $file->getClientOriginalName());
    
        // Debug: Check the file path

        // Pass the company_ID to the IngredientsImport constructor
        Excel::import(new IngredientsImport($companyId), storage_path('app/excel/ingredient_list.xlsx'));
    
        return redirect(route('ingredient.manage'));
    }    

}
