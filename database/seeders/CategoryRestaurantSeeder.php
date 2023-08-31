<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

<<<<<<<< HEAD:database/seeders/CategoryRestaurantSeeder.php
class CategoryRestaurantSeeder extends Seeder
========
class ProductSeeder extends Seeder
>>>>>>>> emanuele-seeding:database/seeders/ProductSeeder.php
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsData = config('store.products');

        foreach ($productsData as $product) {
            Product::create($product);
        }
    }
}
