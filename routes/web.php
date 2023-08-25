<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware(['auth'])->prefix('restaurants')->group(function () {

    // Restaurants routes

    //create
    Route::get('create', [RestaurantController::class, 'create'])->name('restaurants.create');

    //store
    Route::post('store', [RestaurantController::class, 'store'])->name('restaurants.store');
    Route::get('show/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->prefix('products')->group(function () {

    // Product routes

    //create
    Route::get('create', [ProductController::class, 'create'])->name('products.create');

    //store
    Route::post('store', [ProductController::class, 'store'])->name('products.store');

    //show
    Route::get('show/{products}', [ProductController::class, 'show'])->name('products.show');

});