<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showMenu(Request $request, $id)
    {

        $request->validate([
            'id' => 'exists:restaurants,id',
        ]);

        $products = Product::where('restaurant_id', $id)->get();

        $data = [
            'status' => true,
            'results' => $products
        ];

        return response()->json($data);
    }
}
