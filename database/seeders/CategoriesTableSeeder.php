<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryNames = [
            "men's fashion",
            "women's fashion",
            "women's accessories",
            "men's accessories",
            "discount deals",
            
            "kids",
            "best sellers",
            "new arrivals",
            //"fashion",
            //"accesories",
        ];

        foreach ($categoryNames as $categoryName) {
            try {
                $categories[] = Category::factory()->create([
                    'name' => $categoryName,
                    'slug' => Str::slug($categoryName),
                    'description' => fake()->paragraph,
                ]);
            } catch (\Exception $e) {
                // do nothing
            }
        }
    }
}
