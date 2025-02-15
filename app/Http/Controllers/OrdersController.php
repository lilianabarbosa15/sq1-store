<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use NumberFormatter;

class OrdersController extends Controller
{
    public function __invoke()
    {
        $orders = Order::with(['order_items'])->where('user_id', auth()->id())->paginate(6);

        return view('orders', [
            'orders' => $orders
        ]);
    }
}
