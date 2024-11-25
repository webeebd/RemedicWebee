<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'guest'], function() {
    Route::post('fetch-cart', [App\Http\Controllers\API\UserController::class, 'fetchItem']);
    Route::post('cart', [App\Http\Controllers\API\UserController::class, 'addItem']);
    Route::post('delete-cart/{id}', [App\Http\Controllers\API\UserController::class, 'removeItem']);
});

Route::group(['prefix' => 'v1'], function() {
    Route::get('home', [App\Http\Controllers\API\HomeController::class, 'index']);
    Route::post('customer/login', [App\Http\Controllers\API\HomeController::class, 'authentication']);
    Route::post('customer/register', [App\Http\Controllers\API\HomeController::class, 'registration']);
    /*Route::group(['middleware' => ['auth:admin']], function() {
        //Route::post('dropzone', [App\Http\Controllers\ProductsController::class, 'storeImages']);
        //Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    });*/
    Route::post('store/products', [App\Http\Controllers\API\ProductController::class, 'index']);
    Route::post('store-filters', [App\Http\Controllers\API\ProductController::class, 'filters']);
    Route::post('store/products/details', [App\Http\Controllers\API\ProductController::class, 'productDetails']);
    Route::group(['middleware' => ['auth:api']], function() {
        //Route::post('dropzone', [App\Http\Controllers\ProductsController::class, 'storeImages']);
        Route::get('address', [App\Http\Controllers\API\UserController::class, 'fetchAddress']);
        Route::get('profile', [App\Http\Controllers\API\UserController::class, 'fetchProfile']);
        Route::get('address-deactivate/{id}', [App\Http\Controllers\API\UserController::class, 'removeAddress']);
        Route::post('address', [App\Http\Controllers\API\UserController::class, 'addAddress']);
        Route::post('change-password', [App\Http\Controllers\API\UserController::class, 'updatePassword']);
        Route::post('checkout', [App\Http\Controllers\API\UserController::class, 'checkout']);

        Route::post('orders', [App\Http\Controllers\API\UserController::class, 'fetchOrders']);
        Route::post('orders-details', [App\Http\Controllers\API\UserController::class, 'orderDetails']);
        Route::delete('orders-details/{id}', [App\Http\Controllers\API\UserController::class, 'cancelOrder']);

        Route::post('fetch-cart', [App\Http\Controllers\API\UserController::class, 'fetchItem']);
        Route::post('cart', [App\Http\Controllers\API\UserController::class, 'addItem']);
        Route::post('delete-cart/{id}', [App\Http\Controllers\API\UserController::class, 'removeItem']);
    });
});
