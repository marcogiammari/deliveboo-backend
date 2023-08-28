<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index() {

        $restaurants = Restaurant::all();

        $response = [
            "success" => true,
            "results" => $restaurants
        ];

        return response()->json($response);

    }

    public function filterByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        $restaurants = $category->restaurants;
    
        $response = [
            "success" => true,
            "results" => $restaurants
        ];

        return response()->json($response);
    }

}
