<?php

namespace App\Http\Controllers;

use App\Models\CostDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\DishDetail;
use App\Models\RecipeDetail;
use App\Models\MenuDetail;
use App\Models\PriceDetail;
use Illuminate\Http\Request;

class MenuDetailController extends Controller
{
    public function index() {
        $menus = MenuDetail::with('dish')->get();
        $dishes = DishDetail::all();
        $photoUrls = [];
    
        foreach ($dishes as $dish) {
            if ($dish->dish_photo) {
                // Generate URL for the dish photo
                $photoUrls[$dish->dish_ID] = Storage::url('dish_photos/' . $dish->dish_photo);
            }
        }
    // dd($photoUrls);
        return view('ManageMenu.menuAdmin', compact('menus','dishes','photoUrls'));
    }

    public function show($id) {

        $menu = MenuDetail::with('dish')->findOrFail($id);
        $dishId = $menu->dish_ID;
        $recipes = RecipeDetail::where('dish_ID', $dishId)->with('ingredient')->get();
        // dd($recipes);
        $photoUrl = null;

        $costSetting = CostDetail::all();
        $priceDetail = PriceDetail::where('dish_ID', $dishId)->firstOrFail();
        // dd($costSetting);
        if ($menu->dish->dish_photo) {
            // Generate URL for the dish photo
            $photoUrl = Storage::url('dish_photos/' . $menu->dish->dish_photo);
        }
    
        return view('ManageMenu.viewRecipe', compact('recipes', 'photoUrl', 'menu', 'costSetting','priceDetail'));
    }

    public function delete(Request $request, $id) {
        $menu = MenuDetail::findOrFail($id);
    
        // Delete related price details
        foreach ($menu->dish->priceDetails as $priceDetail) {
            $priceDetail->delete();
        }
    
        // Delete the menu item
        $menu->delete();
    
        return redirect(route('menu.manage'))->with('success', 'Menu and related price details deleted successfully.');
    }
    

    public function indexCus() {
        $dishes = DishDetail::all();
        $menus = MenuDetail::all();
        $recipes = RecipeDetail::with('ingredient')->get(); // Load ingredients for recipes
        $photoUrls = [];
    
        foreach ($dishes as $dish) {
            if ($dish->dish_photo) {
                // Generate URL for the dish photo
                $photoUrls[$dish->dish_ID] = Storage::url('dish_photos/' . $dish->dish_photo);
            }
        }
    
        return view('ManageMenu.menu', compact('dishes','photoUrls','recipes', 'menus'));
    }

    public function menuTable() {
        // $menus = MenuDetail::paginate(10); // Paginate with 10 items per page, adjust as needed
        $menus = MenuDetail::with('dish')->get();
        return view('ManageMenu.menuManage', ['menus' => $menus]);
    }
    
    public function updateStatus(Request $request, $id) 
    {
        // Find the dish by its ID
        $dish = DishDetail::find($id);
        $dish -> update($request->all());

        return redirect(route('menu.manage'));
    }
    
    // public function addToCart(Request $request, $dishId)
    // {
    //     // Retrieve dish details from the database based on $dishId
    //     $dish = DishDetail::find($dishId);
        
    //     // Check if dish exists
    //     if (!$dish) {
    //         return redirect()->back()->with('error', 'Dish not found');
    //     }
        
    //     // Add dish to the cart stored in the session
    //     $cart = $request->session()->get('cart', []);
    //     $cart[$dishId] = [
    //         'name' => $dish->dish_name,
    //         'price' => $dish->dish_cost,
    //         'quantity' => $request->input('quantity'),
    //     ];
    //     $request->session()->put('cart', $cart);
        
    //     return redirect()->route('cart.view')->with('success', 'Dish added to cart');
    // }
    
    // public function viewCart(Request $request)
    // {
    //     $cart = $request->session()->get('cart', []);
    
    //     return view('ManageOrder.cart', compact('cart'));
    // }
    
    // public function confirmOrder(Request $request)
    // {
    //     // Get the cart from the session
    //     $cart = $request->session()->get('cart', []);

    //     // Validate the request
    //     $request->validate([
    //         'menu'
    //     ]);

    //     // Save the order to the database
    //     $order = new OrderDetail();

    //     // You may need to adjust this based on your actual Order model structure
    //     $order->items = $cart;

    //     // Save the order
    //     $order->save();

    //     // Destroy the session after the order is confirmed
    //     $request->session()->forget('cart');

    //     return redirect()->route('order.confirmation')->with('success', 'Order confirmed and saved.');
    // }

    // public function confirmOrder(Request $request)
    // {
    //     // Get cart data from session
    //     $cart = Session::get('cart', []);
    
    //     // Validate cart data (e.g., ensure all required fields are present)
    
    //     // Save order and order items to the database
    //     $order = new Order();
    //     $order->user_id = Auth::id(); // Assuming you have user authentication
    //     $order->save();
    
    //     foreach ($cart as $itemId => $itemData) {
    //         $orderItem = new OrderItem();
    //         $orderItem->order_id = $order->id;
    //         $orderItem->item_id = $itemId;
    //         $orderItem->name = $itemData['name'];
    //         $orderItem->price = $itemData['price'];
    //         $orderItem->quantity = $itemData['quantity'];
    //         $orderItem->save();
    //     }
    
    //     // Clear the cart from the session
    //     Session::forget('cart');
    
    //     return redirect()->route('checkout.success')->with('success', 'Order placed successfully');
    // }
    

    // public function indexCus() {
    //     // Retrieve dishes with dish_status set to "on"
    //     $dishes = DishDetail::where('dish_status', 'on')->get();
    //     $photoUrls = [];
    
    //     foreach ($dishes as $dish) {
    //         if ($dish->dish_photo) {
    //             // Generate URL for the dish photo
    //             $photoUrls[$dish->dish_ID] = Storage::url('dish_photos/' . $dish->dish_photo);
    //         }
    //     }
    
    //     // dd($photoUrls);
    //     return view('ManageMenu.menu', ['dishes' => $dishes, 'photoUrls' => $photoUrls]);
    // }
    
}
