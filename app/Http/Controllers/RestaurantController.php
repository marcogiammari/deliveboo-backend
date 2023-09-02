<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRestaurantRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::latest()->paginate(20);
        return view('restaurants.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {

        $data = $request->validated();

        // salva nello storage l'immagine e nell'istanza il path
        if (isset($data['thumb'])) {
            $img_path = Storage::disk('public')->put("uploads", $data['thumb']);
            $data['thumb'] = $img_path;
        }

        $newRestaurant = new Restaurant();
        $newRestaurant->fill($data);

        // ricava la foreign key dall'id dell'utente autenticato
        $newRestaurant->user_id = Auth::user()->id;
        $newRestaurant->save();

        $newRestaurant->categories()->attach($data['categories']);

        return redirect()->route("restaurants.show", $newRestaurant)->with('flash', 'Ristorante aggiunto con successo');

    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        return view("restaurants.show", compact("restaurant"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        $categories = Category::all();
        return view("restaurants.edit", compact("restaurant", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRestaurantRequest $request, Restaurant $restaurant)
    {
        $data = $request->validated();

        // salva nello storage l'immagine e nell'istanza il path
        if (isset($data['thumb'])) {
            $img_path = Storage::disk('public')->put("uploads", $data['thumb']);
            $data['thumb'] = $img_path;
        }

        $restaurant->fill($data);
        $restaurant->update();

        return redirect()->route("restaurants.show", $restaurant, )->with('flash', 'Il tuo ristorante è stato aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->products()->delete();
        $restaurant->delete();
        return redirect()->route("home")->with('flash', 'Ristorante cancellato con successo');
    }
}