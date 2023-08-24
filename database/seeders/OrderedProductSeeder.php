<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderedProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderedproductsData = config('store.orderedProduct');

        foreach ($orderedproductsData as $orderedproduct) {
            DB::table('ordered_product')->insert([
            'order_id' => $orderedproduct['order_id'],
            'product_id' => $orderedproduct['product_id'],
            'quantity' => $orderedproduct['quantity'],
        ]);
        }
    }
}
