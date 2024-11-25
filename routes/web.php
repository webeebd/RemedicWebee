<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/tstfront', function () {
    return homeBuilder();
});
Route::get('sign-in', [App\Http\Controllers\Auth\CustomerLoginController::class, 'showLoginForm']);
Route::post('customer-login', [App\Http\Controllers\Auth\CustomerLoginController::class, 'login']);
Route::post('signup',  [App\Http\Controllers\PageController::class, 'signup']);
Route::get('signup',  [App\Http\Controllers\PageController::class, 'signupForm']);
Route::get('wishlist',  [App\Http\Controllers\CartController::class, 'wishlist']);
Route::get('getcart', [App\Http\Controllers\CartController::class,'getCartProduct']);
Route::get('order-confirmation', [App\Http\Controllers\CheckoutController::class,'orderConfirmation']);
Route::get('cart/{idproduct}/delete', [App\Http\Controllers\CartController::class,'deleteCartItem']);
Route::resource('cart', App\Http\Controllers\CartController::class);
Route::resource('checkout', App\Http\Controllers\CheckoutController::class);
Route::get('/search-product', [App\Http\Controllers\PageController::class, 'searchProduct']);

Route::get('/', [App\Http\Controllers\PageController::class, 'index']);
Route::get('/home', [App\Http\Controllers\PageController::class, 'index']);
Route::get('about', [App\Http\Controllers\PageController::class, 'about']);
Route::get('contact-us', [App\Http\Controllers\PageController::class, 'contactUs']);
Route::post('contactus', [App\Http\Controllers\PageController::class, 'saveContactUs']);
Route::get('product/{slug}', [App\Http\Controllers\PageController::class, 'productDetail']);
Route::get('category/{slug}', [App\Http\Controllers\PageController::class, 'categoryDetail']);
Route::get('shop', [App\Http\Controllers\PageController::class, 'shopPage']);
Route::get('privacy-policy', [App\Http\Controllers\PageController::class, 'privacyPolicy']);
Route::get('terms-conditions', [App\Http\Controllers\PageController::class, 'termsConditions']);

Route::group(['middleware' => ['auth']], function() {
    Route::get('order-history', [App\Http\Controllers\Customer\CustomerController::class, 'orderHistory']);
    Route::get('amc-history', [App\Http\Controllers\Customer\CustomerController::class, 'amcHistory']);
    Route::post('update-profile', [App\Http\Controllers\Customer\CustomerController::class, 'updateProfile']);
    Route::get('profile', [App\Http\Controllers\Customer\CustomerController::class, 'profile']);
    Route::get('manage-profile', [App\Http\Controllers\Customer\CustomerController::class, 'manageProfile']);
    Route::post('add-address', [App\Http\Controllers\Customer\CustomerController::class, 'addAddresses']);
    Route::get('addresses/{id}/edit', [App\Http\Controllers\Customer\CustomerController::class, 'editAddress']);
    Route::post('update-address', [App\Http\Controllers\Customer\CustomerController::class, 'updateAddress']);
    Route::get('addresses', [App\Http\Controllers\Customer\CustomerController::class, 'addresses']);
    Route::post('logout', [App\Http\Controllers\Auth\CustomerLoginController::class, 'logout'])->name('customer.logout');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

    Route::group(['middleware' => ['auth:admin']], function() {
        Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'dashboard']);
        Route::get('kpi', [App\Http\Controllers\HomeController::class, 'kpi']);
		//Route::get('categories', [App\Http\Controllers\CategoriesController::class, 'index']);
        //Route::get('departments', [App\Http\Controllers\DepartmentsController::class, 'index']);
        //Route::get('amcs', [App\Http\Controllers\AmcMasterController::class, 'index']); 
        //Route::get('discounts', [App\Http\Controllers\DiscountsController::class, 'index']);
        Route::get('products', [App\Http\Controllers\ProductsController::class, 'index']);
        //Route::get('manage-products', [App\Http\Controllers\ProductsController::class, 'index']);
        //Route::get('customers', [App\Http\Controllers\CustomersController::class, 'index']);
        Route::resource('roles', App\Http\Controllers\RolesController::class);
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::resource('brands', App\Http\Controllers\BrandsController::class);
        Route::resource('permissions', App\Http\Controllers\PermissionsController::class);
        Route::resource('categories', App\Http\Controllers\CategoriesController::class);
        Route::resource('departments', App\Http\Controllers\DepartmentsController::class);
        Route::resource('amc-master', App\Http\Controllers\AmcMasterController::class);
        Route::resource('discounts', App\Http\Controllers\DiscountsController::class);
        Route::resource('products', App\Http\Controllers\ProductsController::class);
        Route::resource('amc', App\Http\Controllers\AmcOrdersController::class);
        Route::resource('orders', App\Http\Controllers\OrdersController::class);
        Route::resource('customers', App\Http\Controllers\CustomersController::class);
        Route::resource('inventory', App\Http\Controllers\InventoryController::class);
        //Route::get('orders', [App\Http\Controllers\OrdersController::class, 'index']);
        //Route::get('amc/order', [App\Http\Controllers\AmcOrdersController::class, 'index']);
		/*Route::get('{any}', function () {
            return view('home');
        })->where('any', '.*');*/
    });
});

Route::group(['prefix' => 'admin-api'], function() {
    Route::group(['middleware' => ['auth:admin']], function() {
        Route::get('roles', [App\Http\Controllers\RolesController::class, 'index']);
        Route::get('users', [App\Http\Controllers\UserController::class, 'index']);
        Route::get('amc-master', [App\Http\Controllers\AmcMasterController::class, 'index']);
        Route::get('departments', [App\Http\Controllers\DepartmentsController::class, 'index']);
        Route::get('brands', [App\Http\Controllers\BrandsController::class, 'index']);
        Route::get('categories', [App\Http\Controllers\CategoriesController::class, 'index']);
        Route::get('discounts', [App\Http\Controllers\DiscountsController::class, 'index']);
        Route::get('products', [App\Http\Controllers\ProductsController::class, 'index']);
        Route::get('inventory', [App\Http\Controllers\InventoryController::class, 'index']);
        Route::get('customers', [App\Http\Controllers\CustomersController::class, 'index']);
        Route::delete('users/{id}', [App\Http\Controllers\RolesController::class, 'destroy']);
        Route::delete('roles/{id}', [App\Http\Controllers\RolesController::class, 'destroy']);
        Route::delete('brands/{id}', [App\Http\Controllers\BrandsController::class, 'destroy']);
        Route::delete('departments/{id}', [App\Http\Controllers\DepartmentsController::class, 'destroy']);
        Route::delete('categories/{id}', [App\Http\Controllers\CategoriesController::class, 'destroy']);
        Route::delete('amc-master/{id}', [App\Http\Controllers\AmcMasterController::class, 'destroy']);
        Route::delete('discounts/{id}', [App\Http\Controllers\DiscountsController::class, 'destroy']);
        Route::delete('products/{id}', [App\Http\Controllers\ProductsController::class, 'destroy']);
        Route::get('category', [App\Http\Controllers\CategoriesController::class, 'fetchCategories']);
        Route::get('fetch/categories', [App\Http\Controllers\CategoriesController::class, 'fetchSelectCategories']);
        Route::get('fetch/department', [App\Http\Controllers\DepartmentsController::class, 'fetchSelectDepartments']);
        Route::get('fetch/brand', [App\Http\Controllers\BrandsController::class, 'fetchSelectBrands']);
        Route::get('fetch/amc/plans', [App\Http\Controllers\AmcMasterController::class, 'fetchSelectPlans']);
        Route::get('fetch/customers/{id}', [App\Http\Controllers\CustomersController::class, 'customerSummary']);
        Route::get('products/{status}/{id}', [App\Http\Controllers\ProductsController::class, 'manageStatus']);
        Route::get('discounts/fetch/{id}', [App\Http\Controllers\DiscountsController::class, 'fetchDiscount']);
        Route::post('upload', [App\Http\Controllers\ProductsController::class, 'storeImages']);
        Route::post('orders', [App\Http\Controllers\OrdersController::class, 'fetchorders']);
        Route::post('amc', [App\Http\Controllers\AmcOrdersController::class, 'fetchamc']);
        Route::post('inventory/{id}', [App\Http\Controllers\InventoryController::class, 'update']);
        //Route::get('kpi', [App\Http\Controllers\PermissionsController::class, 'fetchKpis']);
        Route::post('kpi', [App\Http\Controllers\PermissionsController::class, 'storeKpis']);
        Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    });
});
