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
        
        $restaurant = Restaurant::select('id')->where('user_id', Auth::user()->id)->first();
        $products = DB::table('products')->where('restaurant_id', $restaurant->id)->get();

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
        
        // ricavo il restaurant_id dalla query sull'id dell'utente autenticato
        $restaurant = Restaurant::select('id')->where('user_id', Auth::user()->id)->first();
        $product->restaurant_id = $restaurant->id;

        $product->save();

        return redirect()->route("products.show", $product);

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view("products.show", $product);
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
    public function destroy()
    {
        // return redirect()->route("product.index");
    }
}
