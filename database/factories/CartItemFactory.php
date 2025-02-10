<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\ProductVariant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productVariantsIds = ProductVariant::all()->pluck("id")->toArray();
        $shoppingCartIds = ShoppingCart::all()->pluck("id")->toArray();

        $variantIdSelected = $this->faker->randomElement($productVariantsIds);
        
        return [
            'shopping_cart_id'=> $this->faker->randomElement($shoppingCartIds),
            'product_variant_id'=> $variantIdSelected,
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'quantity' => $this->faker->numberBetween(1, 10),
            'unit_price' => $this->getUnitPrice($variantIdSelected),
        ];
    }

    function getUnitPrice(int $variant_id): float {
        $price = 0;
        $product_variant = ProductVariant::find($variant_id);
        $sale_price = $product_variant->sale_price;
        
        if (isset($sale_price)) {
            $price = $sale_price;
        } else {
            $product = Product::find($product_variant->product_id);
            $price = $product->price;
        }

        return $price;
    }
}
