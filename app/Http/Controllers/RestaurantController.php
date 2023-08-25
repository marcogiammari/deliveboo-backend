<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRestaurantRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        
        
        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        
        $data = $request->validated();
        
        $newRestaurant = new Restaurant();
        $newRestaurant->fill($data);
        $newRestaurant->user_id = Auth::user()->id;
        $newRestaurant->save();
        
        return redirect()->route("restaurants.show",$newRestaurant);

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
