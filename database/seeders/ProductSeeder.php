<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsData = config('store.products');

        foreach ($productsData as $product) {
            $newProduct = new Product();
            $newProduct->fill($product);
        
            $newProduct['thumb'] = 'placeholders\placeholder.jpg';

            $newProduct->save();
        }
    }
}
