<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __invoke():View
    {
        return view('pages.checkout', [
            //'categories' => $categories
        ]);
    }
}
