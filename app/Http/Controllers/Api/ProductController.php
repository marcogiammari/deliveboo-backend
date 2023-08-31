<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showMenu(Request $request, $id)
    {

        $request->validate([
            'id' => 'exists:restaurants,id',
        ]);

        $products = Product::where('restaurant_id', $id)->get();
        $restaurant = Restaurant::findOrFail($id);

        $data = [
            'status' => true,
            'results' => [
                'restaurant' => $restaurant,
                'products' => $products
            ]
        ];

        return response()->json($data);
    }
}
