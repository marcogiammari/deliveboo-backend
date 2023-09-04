<?php

use App\Http\Controllers\Api\CategoryController as ApiCategoryController;
use App\Http\Controllers\Api\RestaurantController as ApiRestaurantController;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\OrderController as ApiOrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/restaurants', [ApiRestaurantController::class, "index"]);

Route::get('/categories', [ApiCategoryController::class, "index"]);

Route::get('/restaurants/by-categories', [ApiRestaurantController::class, 'filterByCategories']);

Route::get('/menu/{id}', [ApiProductController::class, 'showMenu']);

// ORDER API

// TOKEN ROUTE
Route::get('/orders/generate', [ApiOrderController::class, 'generate']);
//PAYMENT ROUTE
Route::post('/orders/make/payment', [ApiOrderController::class, 'makepayment']);
// PRODUCTS ROUTE
Route::get('products', [ApiProductController::class, 'index']);