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
use App\Http\Controllers\PriceComparisonController;
use App\Http\Controllers\PriceDetailController;
use App\Http\Controllers\SupplierDetailController;

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');
	// Route::get('/current-time', [HomeController::class, 'showCurrentTime'])->name('time');
	// Route::get('/menuCus', [MenuDetailController::class, 'indexCus'])->name('menu.cus');
	// Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	// Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard',  [HomeController::class, 'index'])->name('home');
	Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
	
	//Ingredient
	Route::get('/ingredient', [IngredientDetailController::class, 'index'])->name('ingredient');
	Route::get('/ingredient-export', [IngredientDetailController::class, 'export'])->name('ingredient.export');
	Route::get('/ingredient-add', [IngredientDetailController::class, 'createIngredient'])->name('ingredient.create');
	Route::post('/ingredient-store', [IngredientDetailController::class, 'storeIngredient'])->name('ingredient.store');
	Route::get('/ingredient-edit/{ingredient_name}', [IngredientDetailController::class, 'editIngredient'])->name('ingredient.edit');
	Route::post('/ingredient-update/{id}', [IngredientDetailController::class, 'updateIngredient'])->name('ingredient.update');
	Route::get('/ingredient-delete/{id}', [IngredientDetailController::class, 'deleteIngredient'])->name('ingredient.delete');
	
	//Supplier
	Route::get('/company-manage', [SupplierDetailController::class, 'company_index'])->name('company.manage');
	Route::get('/supplier-add', [SupplierDetailController::class, 'createSupplier'])->name('supplier.create');
	Route::post('/supplier-store', [SupplierDetailController::class, 'upload_excel_file'])->name('supplier.store');
	Route::get('/supplier-edit/{company_name}', [SupplierDetailController::class, 'editSupplier'])->name('supplier.edit');
	Route::post('/supplier-update/{companyId}', [SupplierDetailController::class, 'updateSupplier'])->name('supplier.update');
	Route::get('/supplier-delete/{id}', [SupplierDetailController::class, 'deleteSupplier'])->name('supplier.delete');
	
	//Price Comparison
	Route::get('/ingredient-manage', [PriceComparisonController::class, 'ingredient_index'])->name('ingredient.manage');
	
	//Dish
	Route::get('/dish-manage', [DishDetailController::class, 'index'])->name('dish.manage');
	Route::get('/dish-add', [DishDetailController::class, 'create'])->name('dish.create');
	Route::post('/dish-store', [DishDetailController::class, 'store'])->name('dish.store');
	Route::get('/dish-show/{id}', [DishDetailController::class, 'show'])->name('dish.show');
	Route::get('/dish-edit/{id}', [DishDetailController::class, 'edit'])->name('dish.edit');
	Route::post('/dish-update/{id}', [DishDetailController::class, 'update'])->name('dish.update');
	Route::get('/dish-delete/{id}', [DishDetailController::class, 'delete'])->name('dish.delete');
	Route::get('/export', [DishDetailController::class, 'exportToExcel'])->name('export.dishes');
	
	//Calculation
	Route::get('/calculator-selection', [CalculationController::class, 'index'])->name('calculator.selection');
	Route::get('/menu-price-calculator', [CalculationController::class, 'menuPriceCalculator'])->name('calculator.menu');
	Route::get('/cash-margin-calculator', [CalculationController::class, 'cashMarginCalculator'])->name('calculator.margin');
	Route::post('/calculate-menu-price', [CalculationController::class, 'calculateMenuPrice'])->name('calculation.menu');
	Route::post('/calculate-cash-margin', [CalculationController::class, 'calculateMargin'])->name('calculation.margin');
	Route::post('/menu-store', [CalculationController::class, 'storeMenu'])->name('menu.store');
	
	//Indirect Cost
	// Route::get('/cost-setting', [CostDetailController::class, 'index'])->name('cost.setting');
	Route::get('/cost-manage', [CostDetailController::class, 'index'])->name('cost.manage');
	Route::get('/cost-add', [CostDetailController::class, 'create'])->name('cost.create');
	Route::post('/cost-store', [CostDetailController::class, 'store'])->name('cost.store');
	Route::get('/cost-edit/{id}', [CostDetailController::class, 'edit'])->name('cost.edit');
	Route::post('/cost-update/{id}', [CostDetailController::class, 'update'])->name('cost.update');
	Route::get('/cost-delete/{id}', [CostDetailController::class, 'delete'])->name('cost.delete');	
	
	//Menu Price
	Route::get('/price-setting', [PriceDetailController::class, 'settingPrice'])->name('price.setting');
	Route::post('/price-store', [PriceDetailController::class, 'storeMenuPrice'])->name('price.store');
	
	//Menu
	Route::get('/menu', [MenuDetailController::class, 'index'])->name('menu');
	Route::get('/cart', [MenuDetailController::class, 'viewCart'])->name('cart.view');
	Route::get('/menu-show/{id}', [MenuDetailController::class, 'show'])->name('menu.show');
	Route::get('/menu-manage', [MenuDetailController::class, 'menuTable'])->name('menu.manage');
	Route::get('/menu-delete/{id}', [MenuDetailController::class, 'delete'])->name('menu.delete');
	Route::post('/update-status/{id}', [MenuDetailController::class, 'updateStatus'])->name('status.update');
	Route::get('/recipe-manage', [MenuDetailController::class, 'indexRecipe'])->name('recipe.manage');
	Route::get('/menu-create', [MenuDetailController::class, 'createMenu'])->name('menu.create');
	// Route::get('/add-to-cart/{itemId}', [MenuDetailController::class, 'addToCart'])->name('addToCart');

