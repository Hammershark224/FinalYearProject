<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\DishDetail;
use App\Models\IngredientDetail;
use App\Models\MenuDetail;
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
        // $suppliers = SupplierDetail::all();
        // $ingredientList = IngredientDetail::with('lowestPrice')->get();
        // $ingredientList = IngredientDetail::with(['suppliers' => function ($query) {
        //     $query->orderBy('ingredient_price', 'asc')->take(2);
        // }])->get();
        $ingredientList = DB::table('supplier_details')
        ->select(
            'ingredient_details.ingredient_ID',
            'ingredient_details.ingredient_name',
            'ingredient_details.ingredient_weight',
            DB::raw('MIN(supplier_details.ingredient_price) as lowest_price')
        )
        ->join('ingredient_details', 'supplier_details.ingredient_ID', '=', 'ingredient_details.ingredient_ID')
        ->groupBy('ingredient_details.ingredient_ID')
        ->get();
        
        // $ingredientList = DB::select('select * from supplier_details join ingredient_details on supplier_details.ingredient_ID = ingredient_details.ingredient_ID GROUP BY ingredient_name');
        // dd($ingredientList);
        
        return view('ManageDish.addDish', compact('ingredientList'));
    }

    public function store(Request $request) {
        // Validate the request data
        $request->validate([
            'dish_name' => 'required|string',
            'dish_description' => 'required|string',
            'dish_cost' => 'required|numeric',
            'dish_status' => 'required',
            'dish_photo' => 'required',
            'ingredients' => 'required|array', // Ensure 'ingredients' is an array
            'recipe_weight' => 'required|array', // Ensure 'recipe_weight' is an array
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
    
        $ingredients = $request->input('ingredients');
        $recipeWeights = $request->input('recipe_weight');
    
        // Combine ingredients and their respective weights into an associative array
        $ingredientsData = array_combine($ingredients, $recipeWeights);
    
        foreach ($ingredientsData as $ingredientId => $recipeWeight) {
            RecipeDetail::create([
                'dish_ID' => $dish->dish_ID,
                'ingredient_ID' => $ingredientId,
                'recipe_weight' => $recipeWeight,
            ]);
        }
    
        return redirect(route('dish.manage'));
    }
    
    
    public function show($id) {
        $dataDish = DishDetail::findOrFail($id);
        $recipes = RecipeDetail::where('dish_ID', $id)->with('ingredient')->get();
        $photoUrl = null;
    
        if ($dataDish->dish_photo) {
            // Generate URL for the dish photo
            $photoUrl = Storage::url('dish_photos/' . $dataDish->dish_photo);
        }
    
        return view('ManageDish.viewDish', ['dataDish' => $dataDish, 'recipes' => $recipes, 'photoUrl' => $photoUrl]);
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

    public function update($id) {
        
    }

    public function delete($id) {
        $dataDish = DishDetail::find($id);
        $ingredients = RecipeDetail::where('dish_ID',$id)->delete();
        $menu = MenuDetail::where('dish_ID',$id)->delete();
        $dataDish -> delete();
        return redirect(route('dish.manage'));
    }
}
