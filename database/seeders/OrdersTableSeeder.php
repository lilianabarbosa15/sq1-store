<?php

namespace Database\Seeders;
use App\Models\Order;
use App\Models\ShoppingCart;
use App\Models\CartItem;
use App\Models\OrderItem;

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        // Obtiene los shopping_carts que están en estado "checked_out"
        $shoppingCarts = ShoppingCart::where('status', 'checked_out')->get();

        foreach ($shoppingCarts as $cart) {
            // Crea una nueva orden basada en el shopping cart
            $order = Order::factory()->create([
                'user_id' => $cart->user_id,
                'total_amount' => 0,        ////////////
                'order_status' => $faker->randomElement(['pending', 'completed', 'shipped', 'cancelled']),
                'payment_method' => $faker->randomElement(['Visa', 'MasterCard', 'Discover', 'UnionPay', 'Diners Club', 'JCB', 'AMEX']),
                'shipping_address' => $faker->address,
            ]);

            $total_amount = 0;
            $cartItems = CartItem::where('shopping_cart_id', $cart->id)->get();

            // Crea los items de la orden basados en los productos del shopping cart
            foreach ($cartItems as $item) {
                $order_item = OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_variant_id' => $item->product_variant_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price, // Asumiendo que cada item del carrito tiene un precio
                ]);
                $total_amount += ($order_item->quantity * $order_item->unit_price);
            }

            $order->total_amount = $total_amount;
            $order->save();
        }
    }
}