<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShoppingCart>
 */
class ShoppingCartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usersIds = User::all()->pluck("id")->toArray();
        
        return [
            /*
                active = the user is adding products
                checking_out = the user has started the checkout process
                checked_out = the purchase has been completed
                abandoned = the user left the cart without completing the purchase
            */
            'user_id' => $this->faker->randomElement($usersIds),
            'status' => $this->faker->randomElement(['active', 'checking_out', 'checked_out', 'abandoned']),
            'wrap' => $this->faker->boolean(50),
        ];
    }
}
