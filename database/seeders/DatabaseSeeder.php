<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\ShoppingCart;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::factory(15)->create()->each(function ($user) {
            $faker = \Faker\Factory::create();
            
            $hasActiveCart = true; //$faker->boolean(50);

            if ($hasActiveCart) {
                ShoppingCart::factory()->create([
                    'user_id' => $user->id,
                    'status' => 'active',
                    'wrap' => $faker->boolean(50),
                ]);
            }
            
            ShoppingCart::factory(rand(1, 13))->create([
                'user_id' => $user->id,
                'status' => $faker->randomElement(['checking_out', 'checked_out', 'abandoned']),
                'wrap' => $faker->boolean(50),
            ]);
        });

        $this->call([
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            ProductVariantsTableSeeder::class,
            
            CartItemsTableSeeder::class,
            
            OrdersTableSeeder::class,
        ]);

    }
}
