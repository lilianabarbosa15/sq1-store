<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(25)->create()->each(function ($product) 
        {
            $categories = Category::pluck('id')->toArray();     // 
            
            $product->categories()->attach(
                fake()->randomElements($categories, rand(1, count($categories)))
            );
        });
        
    }
}
