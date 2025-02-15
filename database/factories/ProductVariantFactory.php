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
        // Use a static counter to keep track of the number of variants created.
        static $counter = 0;

        $product = Product::inRandomOrder()->first();
        // Retrieve all product IDs in ascending order.
        $productIds = \App\Models\Product::orderBy('id')->pluck('id')->toArray();

        // Ensure there's at least one product.
        if (empty($productIds)) {
            // You can create a default product if none exist, or throw an exception.
            $product = \App\Models\Product::factory()->create();
            $productIds = [$product->id];
        }

        // Select a product ID using a round-robin approach.
        $assignedProductId = $productIds[$counter % count($productIds)];
        $counter++;

        // Retrieve the actual product instance.
        $product = \App\Models\Product::find($assignedProductId);



        $color_data = $this->getRandomColor();  // Fake a hex color (e.g. #ff5733)
        $sale = $this->faker->boolean();

        return [
            'product_id'=> $product,
            'color_name' => $color_data['name'],
            'color' => $color_data['hex'],
            'sale_price' => $sale && $product->price > 5 
                            ? $this->faker->randomFloat(2, 5, $product->price) 
                            : null,
            'sale_end_time' => $sale ? $this->faker->dateTimeBetween('+7 days', '+30 days')->format('Y-m-d\TH:i:s\Z') : null,
            'rating' => $this->faker->numberBetween(1, 5),
            'quantity' => json_encode($this->getQuantity($product->id)),
            'images' => $this->getRandomImages($product->id, $color_data['hex']),
            'review_count' => $this->faker->numberBetween(1, 100),
        ];
    }

    function getQuantity($product_id): array {
        $s_0 = ['m', 'l', 'xl', 'xxl'];
        $s_1 = ['s', 'm', 'l', 'xl'];
        $s_2 = ['xs', 's', 'm', 'l'];
        $s_3 = ['xxs', 'xs', 's', 'm'];

        if ($product_id % 2 === 0) {
            // Si es múltiplo de 2, elige s_1
            $selectedSizes = $s_1;
        } elseif ($product_id % 3 === 0) {
            // Si es múltiplo de 3, elige s_2
            $selectedSizes = $s_2;
        } elseif ($product_id % 5 === 0) {
            // Si es múltiplo de 5, elige s_0
            $selectedSizes = $s_0;
        } elseif ($product_id % 7 === 0) {
            // Si es múltiplo de 7, elige s_3
            $selectedSizes = $s_3;
        } else {
            // Valor por defecto, por ejemplo, s_1
            $selectedSizes = $s_1;
        }

        $quantity = [];
        foreach ($selectedSizes as $size) {
            $quantity[$size] = $this->faker->numberBetween(0, 100);
        }
        return  $quantity;
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
                . Str::slug($color) . '-' 
                . ($i + 1);
        }
    
        return $images;
    }
}
