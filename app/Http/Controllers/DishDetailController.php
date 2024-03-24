<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\DishDetail;
use App\Models\IngredientDetail;
use App\Models\RecipeDetail;
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
        $ingredients = IngredientDetail::all();
        return view('ManageDish.addDish',['ingredients' => $ingredients]);
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
            $request->file('dish_photo')->storeAs('dish_photos', $fileName);
        } else {
            // Handle case when no file is uploaded
            // You can set a default photo or return an error message
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


        // Attach ingredients to the dish
        $ingredients = $request->input('ingredients', []);
        // dd($ingredients);
        // $dish->ingredients()->attach($ingredients);

        foreach ($ingredients as $ingredientId) {
            RecipeDetail::create([
                'dish_ID' => $dish->dish_ID,
                'ingredient_ID' => $ingredientId,
            ]);
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

    public function delete($id) {
        $dataDish = DishDetail::find($id);
        $ingredients = RecipeDetail::where('dish_ID',$id)->delete();
        // foreach($ingredients as $ingredient){
        //     $ingredient->delete();
        // }
        $dataDish -> delete();
        return redirect(route('dish.manage'));
    }
}
