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
    public function index()
    {

        return new RestaurantCollection(Restaurant::all());
    }

    public function filterByCategories(Request $request)
    {
        
        $request->validate([
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id'
        ]);
        
        $categoryIds = $request->input('category_ids');

        $restaurants = Restaurant::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('category_id', $categoryIds);
        }, '=', count($categoryIds))->with('categories')->get();
    
        return response()->json($restaurants);
    }
}
