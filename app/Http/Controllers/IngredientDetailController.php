<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Models\IngredientDetail;
use App\Models\RecipeDetail;
use App\Models\SupplierDetail;
use Illuminate\Http\Request;
use App\Exports\IngredientsExport;

class IngredientDetailController extends Controller
{
    public function index() {
        $ingredients = IngredientDetail::all();
        foreach ($ingredients as $ingredient) {
            $ingredient->photo_url = $ingredient->ingredient_photo ? Storage::url('ingredient_photos/' . $ingredient->ingredient_photo) : null;
        }
        return view('ManageIngredient.ingredientManage', compact('ingredients'));
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
            'ingredient_photo' => 'required',
        ]);

        if ($request->hasFile('ingredient_photo')) {
            $fileName = $request->file('ingredient_photo')->getClientOriginalName();
            $request->file('ingredient_photo')->storeAs('ingredient_photos', $fileName, 'public');
        } else {
            return back()->with('error', 'No ingredient photo uploaded.');
        }

        $company = IngredientDetail::create([
            'ingredient_name' => $request->input('ingredient_name'),
            'ingredient_weight' => $request->input('ingredient_weight'),
            'ingredient_photo' => $fileName,
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
        $dataRecipe = RecipeDetail::where('ingredient_ID',$id)->delete();
        $dataSupplier = SupplierDetail::where('ingredient_ID',$id)->delete();
        $dataIngredient -> delete();
        return redirect(route('ingredient'));
    }

}
