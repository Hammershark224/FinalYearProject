<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\DishDetailController;
use App\Http\Controllers\IngredientDetailController;
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\CostDetailController;
use App\Http\Controllers\MenuDetailController;
use App\Http\Controllers\MenuPricingController;

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

	Route::get('/menuCus', [MenuDetailController::class, 'indexCus'])->name('menu.cus');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard',  [HomeController::class, 'index'])->name('home');
	//Ingredient
	Route::get('/company-manage', [IngredientDetailController::class, 'company_index'])->name('company.manage');
	Route::get('/ingredient', [IngredientDetailController::class, 'index'])->name('ingredient');
	Route::get('/ingredient/search', [IngredientDetailController::class, 'search'])->name('ingredient.search');
	Route::get('/ingredient-manage', [IngredientDetailController::class, 'ingredient_index'])->name('ingredient.manage');
	Route::get('/ingredient-add', [IngredientDetailController::class, 'createIngredient'])->name('ingredient.create');
	Route::post('/ingredient-store', [IngredientDetailController::class, 'storeIngredient'])->name('ingredient.store');
	Route::get('/ingredient-delete/{id}', [IngredientDetailController::class, 'deleteIngredient'])->name('ingredient.delete');
	Route::get('/supplier-add', [IngredientDetailController::class, 'createSupplier'])->name('supplier.create');
	Route::post('/supplier-store', [IngredientDetailController::class, 'upload_excel_file'])->name('supplier.store');
	Route::get('/supplier-delete/{id}', [IngredientDetailController::class, 'deleteSupplier'])->name('supplier.delete');
	Route::get('/ingredient-export', [IngredientDetailController::class, 'export'])->name('ingredient.export');
	//Dish
	Route::get('/dish-manage', [DishDetailController::class, 'index'])->name('dish.manage');
	Route::get('/dish-add', [DishDetailController::class, 'create'])->name('dish.create');
	Route::post('/dish-store', [DishDetailController::class, 'store'])->name('dish.store');
	Route::get('/dish-show/{id}', [DishDetailController::class, 'show'])->name('dish.show');
	Route::get('/dish-edit/{id}', [DishDetailController::class, 'edit'])->name('dish.edit');
	Route::get('/dish-update/{id}', [DishDetailController::class, 'update'])->name('dish.update');
	Route::get('/dish-delete/{id}', [DishDetailController::class, 'delete'])->name('dish.delete');
	Route::get('/export', [DishDetailController::class, 'exportToExcel'])->name('export.dishes');
	//Calculation
	Route::get('/calculator-selection', [CalculationController::class, 'index'])->name('calculator.selection');
	Route::get('/menu-price-calculator', [CalculationController::class, 'menuPriceCalculator'])->name('calculator.menu');
	Route::get('/cash-margin-calculator', [CalculationController::class, 'cashMarginCalculator'])->name('calculator.margin');
	Route::post('/calculate-menu-price', [CalculationController::class, 'calculateMenuPrice'])->name('calculation.menu');
	Route::post('/calculate-cash-margin', [CalculationController::class, 'calculateMargin'])->name('calculation.margin');
	Route::post('/menu-store', [CalculationController::class, 'storeMenu'])->name('menu.store');
	Route::get('/menu-delete/{id}', [CalculationController::class, 'delete'])->name('menu.delete');
	//price
	Route::get('/cost-setting', [CostDetailController::class, 'index'])->name('cost.setting');
	Route::post('/cost-store', [CostDetailController::class, 'store'])->name('cost.store');
	Route::get('/price-setting', [CostDetailController::class, 'settingPrice'])->name('price.setting');
	Route::post('/price-store', [CostDetailController::class, 'storeMenuPrice'])->name('price.store');
	//menu
	Route::get('/menu', [MenuDetailController::class, 'index'])->name('menu');
	Route::get('/add-to-cart/{itemId}', [MenuDetailController::class, 'addToCart'])->name('addToCart');
	Route::get('/cart', [MenuDetailController::class, 'viewCart'])->name('cart.view');
	Route::get('/menu-show/{id}', [MenuDetailController::class, 'show'])->name('menu.show');
	Route::get('/menu-manage', [MenuDetailController::class, 'menuTable'])->name('menu.manage');
	Route::get('/menu-create', [MenuDetailController::class, 'createMenu'])->name('menu.create');
	Route::post('/update-status/{id}', [MenuDetailController::class, 'updateStatus'])->name('status.update');
	Route::get('/recipe-manage', [MenuDetailController::class, 'indexRecipe'])->name('recipe.manage');
	Route::get('/order-create', function () {return view('ManageOrder.createOrder');});


Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

