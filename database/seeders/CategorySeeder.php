<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesData = config('store.categories');

        foreach ($categoriesData as $category) {
            $newCategory = new Category;
            $newCategory->name = $category['name'];
            $newCategory->thumb = str_replace(' ', '', strtolower($category['name']).".png");

            $newCategory->save();
        }
    }
}
