<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {

        // ricava il restaurant_id dalla query sull'id dell'utente autenticato
        $restaurant_id = Restaurant::where('user_id', Auth::user()->id)->value('id');

        // query sui prodotti che possiedono il restaurant_id come foreign key
        $products = Product::where('restaurant_id', $restaurant_id)->where("is_visible", true)->get();

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

        $data = $request->validated();

        
        // salva nello storage l'immagine e nell'istanza il path
        if (isset($data['thumb'])) {
            $img_path = Storage::disk('public')->put("uploads", $data['thumb']);
            $data['thumb'] = $img_path;
        }

        $product = new Product();
        $product->fill($data);
        $product->is_visible = true;


        // ricava il ristorante a cui deve appartenere il prodotto traimite una query sull'id dell'utente connesso
        $restaurant_id = Restaurant::where('user_id', Auth::user()->id)->value('id');
        $product->restaurant_id = $restaurant_id;

        $product->save();

        return redirect()->route("products.show", $product)->with('flash', 'Il tuo prodotto è stato aggiunto con successo');
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

        $data = $request->validated();

        // salva nello storage l'immagine e nell'istanza il path
        if (isset($data['thumb'])) {
            $img_path = Storage::disk('public')->put("uploads", $data['thumb']);
            $data['thumb'] = $img_path;
        }

        $product->fill($data);
        $product->update();

        return redirect()->route("products.show", $product)->with('flash', 'Il tuo prodotto è stato aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        $product->is_visible = false;
        $product->save();
        return redirect()->route('products.index')->with('flash', 'Il prodotto è stato eliminato');
    }
}