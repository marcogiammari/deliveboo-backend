<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantResource;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index() {

        return new RestaurantCollection(Restaurant::all());

    }

    public function filterByCategory($categoryId)
    {

        $category = Category::findOrFail($categoryId);
        $restaurants = $category->restaurants;
    
        return new RestaurantCollection($restaurants);
    }

}
