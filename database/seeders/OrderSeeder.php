<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ordersData = config('store.orders');
        foreach ($ordersData as $index => $order) {
            $menu = Product::where('restaurant_id', $index)->get();
            Order::create($order)->products()->attach($menu, ['quantity' => rand(1,3)]);
        }
    }
}
