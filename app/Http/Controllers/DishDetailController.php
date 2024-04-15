<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\DishDetail;
use App\Models\IngredientDetail;
use App\Models\RecipeDetail;
use App\Models\SupplierDetail;
use Illuminate\Http\Request;
use League\CommonMark\Node\Block\Document;
use PhpParser\Node\Scalar\MagicConst\Dir;

class DishDetailController extends Controller
{
    public function index() {
        $dishes = DishDetail::all();
        return view('ManageDish.dishManage',['dishes'=>$dishes]);
    }

    public function create() {
        $suppliers = SupplierDetail::all();
        return view('ManageDish.addDish',['suppliers' => $suppliers]);
    }

    public function store(Request $request) {
        // Validate the request data
        $request->validate([
            'dish_name' => 'required|string',
            'dish_description' => 'required|string',
            'dish_cost' => 'required|numeric',
            'dish_status' => 'required',
            'dish_photo' => 'required',
        ]);
    
        // Handle file upload
        if ($request->hasFile('dish_photo')) {
            $fileName = $request->file('dish_photo')->getClientOriginalName();
            $request->file('dish_photo')->storeAs('dish_photos', $fileName, 'public');
        } else {
            return back()->with('error', 'No dish photo uploaded.');
        }

        // Create a new dish
        $dish = DishDetail::create([
            'dish_name' => $request->input('dish_name'),
            'dish_description' => $request->input('dish_description'),
            'dish_cost' => $request->input('dish_cost'),
            'dish_status' => $request->input('dish_status'),
            'dish_photo' => $fileName, // Assign the file name to the 'dish_photo' field
        ]);
        // dd($fileName);

        $ingredients = $request->input('ingredients', []);
        // dd($ingredients);

        foreach ($ingredients as $index => $ingredientId) {
            // Check if the 'recipe_weight' array has an element at the current index
            if (isset($request->input('recipe_weight')[$index])) {
                // Retrieve the weight of the ingredient from the request
                $recipeWeight = $request->input('recipe_weight')[$index];
                // dd($request);
                RecipeDetail::create([
                    'dish_ID' => $dish->dish_ID,
                    'ingredient_ID' => $ingredientId,
                    'recipe_weight' => $recipeWeight,
                ]);
                
            } else {
                // Handle the case where 'recipe_weight' is not set for this ingredient
                // You can choose to skip this ingredient or handle it differently based on your requirements
            }
        }
        
        
        return redirect(route('dish.manage'));
    }
    
    public function show($id) {
        $dataDish = DishDetail::findOrFail($id);
        $ingredients = RecipeDetail::where('dish_ID', $id)->with('ingredient')->get();
        $photoUrl = null;
    
        if ($dataDish->dish_photo) {
            // Generate URL for the dish photo
            $photoUrl = Storage::url('dish_photos/' . $dataDish->dish_photo);
        }
    
        return view('ManageDish.viewDish', ['dataDish' => $dataDish, 'ingredients' => $ingredients, 'photoUrl' => $photoUrl]);
    }

    public function edit($id) {
        $dataDish = DishDetail::findOrFail($id);
        $ingredients = RecipeDetail::where('dish_ID', $id)->with('ingredient')->get();
        $photoUrl = null;
    
        if ($dataDish->dish_photo) {
            // Generate URL for the dish photo
            $photoUrl = Storage::url('dish_photos/' . $dataDish->dish_photo);
        }
    
        return view('ManageDish.editDish', ['dataDish' => $dataDish, 'ingredients' => $ingredients, 'photoUrl' => $photoUrl]);
    }

    public function delete($id) {
        $dataDish = DishDetail::find($id);
        $ingredients = RecipeDetail::where('dish_ID',$id)->delete();
        $dataDish -> delete();
        return redirect(route('dish.manage'));
    }
}
