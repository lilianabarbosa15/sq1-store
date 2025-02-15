<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Order;
use App\Models\ProductVariant;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productVariantsIds = ProductVariant::all()->pluck("id")->toArray();
        $ordersIds = Order::all()->pluck("id")->toArray();
        
        return [
            'order_id'=> $this->faker->randomElement($ordersIds),
            'product_variant_id'=> $this->faker->randomElement($productVariantsIds),
            'quantity' => $this->faker->numberBetween(1, 10),
            'unit_price' => $this->faker->randomFloat(2, 10, 700),
        ];
    }
}
