<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

<<<<<<<< HEAD:database/seeders/OrderProductSeeder.php
class OrderProductSeeder extends Seeder
========
class OrderSeeder extends Seeder
>>>>>>>> emanuele-seeding:database/seeders/OrderSeeder.php
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
