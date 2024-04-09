<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\IngredientDetail;
use App\Models\SupplierDetail;
use App\Models\CompanyDetail;
use Illuminate\Http\Request;
use App\Imports\IngredientsImport;

class IngredientDetailController extends Controller
{
    public function index() {
        $companys = CompanyDetail::all();
        $suppliers = SupplierDetail::all();
        $ingredients = IngredientDetail::all();
        return view('ManageIngredient.ingredientManage',['ingredients'=>$ingredients, 'suppliers'=>$suppliers, 'companys'=>$companys]);
    }

    public function create() {
        return view('ManageIngredient.addIngredient');
    }

    public function store(Request $request) {
        $request->validate([
            'company_name' => 'required|string',
            'company_address' => 'required|string',
        ]);

        $company = CompanyDetail::create([
            'company_name' => $request->input('company_name'),
            'company_address' => $request->input('company_address'),
        ]);

        return redirect(route('ingredient.manage'));
    }

    public function importIngredients() {
        Excel::import(new IngredientsImport, 'ingredients.xlsx');
        return redirect(route('ingredient.manage'));
    }
}
