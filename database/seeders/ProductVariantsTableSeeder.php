<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\ProductVariant;

class ProductVariantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductVariant::factory(200)->create();
    }
}
