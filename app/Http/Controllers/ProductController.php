<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {

        // ricava il restaurant_id dalla query sull'id dell'utente autenticato
        $restaurant_id = Restaurant::where('user_id', Auth::user()->id)->value('id');

        // query sui prodotti che possiedono il restaurant_id come foreign key
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

        // ricava il ristorante a cui deve appartenere il prodotto traimite una query sull'id dell'utente connesso
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

        return view("products.show", compact("product"));
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
