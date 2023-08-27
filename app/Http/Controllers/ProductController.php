<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    
    public function index()
    {
        
        // ricavo il restaurant_id dalla query sull'id dell'utente autenticato
        $restaurant_id = Restaurant::where('user_id', Auth::user()->id)->value('id');
        $products = Product::where('restaurant_id', $restaurant_id)->get();

        return view('products.index', compact('products'));
    }
    

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreProductRequest $request)
    {
        
        $validatedData = $request->validated();
        $product = new Product();
        $product->fill($validatedData);
        
        $restaurant_id = Restaurant::where('user_id', Auth::user()->id)->value('id');
        $product->restaurant_id = $restaurant_id;

        $product->save();

        return redirect()->route("products.show", $product);

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $restaurant_id = Restaurant::where('user_id', Auth::user()->id)->value('id');

        if ($product->restaurant_id === $restaurant_id) {
            return view("products.show", compact("product"));
        }

        abort(403);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view("products.edit", ["product" => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
               
        $validatedData = $request->validated();
        $product->fill($validatedData);
        $product->update();

        return redirect()->route("products.show", $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
