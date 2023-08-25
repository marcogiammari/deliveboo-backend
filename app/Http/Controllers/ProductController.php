<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    function generateSlug($stringa) {
        // Converto la stringa in caratteri minuscoli
        $stringa = strtolower($stringa);
        
        // Rimuovo caratteri non alfanumerici
        $stringa = preg_replace('/[^a-z0-9]/', '-', $stringa);
        
        // Rimuovo eventuali caratteri duplicati "-"
        $stringa = preg_replace('/-+/', '-', $stringa);
        
        // Rimuovo eventuali trattini all'inizio o alla fine
        $stringa = trim($stringa, '-');
        
        return $stringa;
    }
    
    public function index()
    {
        // $user = Auth::user();
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
        $product->restaurant_id=1;
        $product->save();
        // $product->slug = $this->generateSlug($validatedData["name"]);

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
