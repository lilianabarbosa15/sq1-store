<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use FakerCommerce\Faker\FakerFactory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerStore = FakerFactory::create();
        $name = $fakerStore->name();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'brand' => $this->faker->randomElement(['minimog', 'retolie', 'brook', 'learts', 'vagabond', 'abby']),
            'price' => $this->faker->randomFloat(2, 10, 700),
            'description' => $this->faker->paragraph(),
        ];
    }
}
