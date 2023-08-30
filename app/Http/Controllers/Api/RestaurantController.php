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
        
        // Validazione dei parametri
        $request->validate([
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id', // Supponendo che le categorie siano nel modello Category
        ]);
        
        $categoryIds = $request->input('category_ids');
        $restaurants = [];
        
        foreach ($categoryIds as $categoryId) {
            $category = Category::findOrFail($categoryId);
    
            $restaurants[] = $category->restaurants()
                ->with('categories') 
                ->get();
        }

        $data = [
            'status' => true,
            'results' => $restaurants[0]
        ];

        return response()->json($data);

        // // return new RestaurantCollection($category);




        // $restaurantsQuery = Restaurant::query();

        // foreach ($categoryIds as $categoryId) {
        //     $restaurantsQuery->whereHas('categories', function ($query) use ($categoryId) {
        //         $query->where('id', $categoryId);
        //     });
        // }

        // $restaurants = $restaurantsQuery->get();

        // return response()->json(['restaurants' => $restaurants]);
    }
}
