<?php

namespace Database\Seeders;

use App\Models\Order;
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
        foreach ($ordersData as $order) {
            Order::create($order);
        }
    }
}
