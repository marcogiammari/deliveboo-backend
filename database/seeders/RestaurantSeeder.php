<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants_data = config('store.restaurants');
        $category_restaurant_data = config('store.category_restaurant');

        foreach ($restaurants_data as $restaurant) {
            $newRestaurant = new Restaurant();
            $newRestaurant->fill($restaurant);
            $newRestaurant->thumb = 'uploads/' . $newRestaurant->thumb;
            $newRestaurant->save();
            $newRestaurant->categories()->attach($category_restaurant_data[$newRestaurant->id]);
        }
    }
}
