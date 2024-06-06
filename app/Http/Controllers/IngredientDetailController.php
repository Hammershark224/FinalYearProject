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

}
