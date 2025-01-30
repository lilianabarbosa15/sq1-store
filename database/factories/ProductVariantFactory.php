<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $color_data = $this->getRandomColor();  // Fake a hex color (e.g. #ff5733)
        $sale = $this->faker->boolean();

        return [
            'product_id'=> $product,
            'color_name' => $color_data['name'],
            'color' => $color_data['hex'],
            'sale_price' => $sale && $product->price > 5 
                            ? $this->faker->randomFloat(2, 5, $product->price) 
                            : null,
            'sale_end_time' => $sale ? $this->faker->dateTimeBetween('-30 days', '+30 days')->format('Y-m-d\TH:i:s\Z') : null,
            'rating' => $this->faker->numberBetween(1, 5),
            'quantity' => json_encode([
                's' => $this->faker->numberBetween(1, 100),
                'm' => $this->faker->numberBetween(1, 100),
                'l' => $this->faker->numberBetween(1, 100),
                'xl' => $this->faker->numberBetween(1, 100),
            ]),
            'images' => $this->getRandomImages($product->id, $color_data['hex']),
            'review_count' => $this->faker->numberBetween(1, 100),
        ];
    }
    
    function getRandomColor(): array {
        $colors = config('colors'); // obtains the colors from the configuration file
        $colorNames = array_keys($colors);

        $nameColor = $colorNames[array_rand($colorNames)];
        $hexColor = $colors[$nameColor];

        return [
            'hex' => (string)$hexColor,
            'name' => (string)$nameColor,
        ];
    }

    function getRandomImages($product_id, $color = '000000', $min = 1, $max = 20): array {
        $count = rand($min, $max);
        $images = [];
    
        for ($i = 0; $i < $count; $i++) {
            $images[] = 'https://imageplaceholder.net/700x900?text=product'
                . Str::slug($product_id) . '-' 
                . Str::slug($color) . '/' 
                . ($i + 1);
        }
    
        return $images;
    }
}
