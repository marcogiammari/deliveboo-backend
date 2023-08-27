<?php

use App\Http\Controllers\HomeController;
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
    return redirect('home');
});

Auth::routes();

Route::middleware(['auth'])->prefix('restaurants')->group(function () {

    // Restaurants routes

    //create
    Route::get('create', [RestaurantController::class, 'create'])->name('restaurants.create');

    //store
    Route::post('store', [RestaurantController::class, 'store'])->name('restaurants.store');

    // show
    Route::middleware(['check-restaurant-ownership'])->group(function () {
        Route::get('{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');
    });
});

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->prefix('products')->group(function () {

    // Product routes
    Route::get('', [ProductController::class, 'index'])->name('products.index');

    Route::post('', [ProductController::class, 'store'])->name('products.store');

    Route::get('create', [ProductController::class, 'create'])->name('products.create');

    Route::middleware(['check-product-ownership'])->group(function () {
        Route::resource('products', ProductController::class)->except('index', 'store', 'create');
    });
});
