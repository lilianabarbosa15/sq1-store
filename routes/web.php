<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Livewire\Volt\Volt;

Route::get('/', HomeController::class)
    ->name('home');





//products
Route::prefix('product')->group( function () {
    //Route::get('/search', [ProductController::class, 'search']);
    //Route::get('/', [ProductController::class, 'index']);       //
    Route::get('/{id}', [ProductController::class, 'show'])->name('show');   
});

//cart
Route::get('/cart', CartController::class)
    ->name('cart');

//checkout
Route::get('/checkout', CheckoutController::class)
    ->name('checkout');



/*
Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');

    Volt::route('login', 'pages.auth.login')
        ->name('login');
});*/


//shopping cart
/*
Route::prefix('cart')->middleware('auth:sanctum')->group( function () {
        Route::get('/', [ShoppingCartController::class, 'index']);
        Route::post('/add', [ShoppingCartController::class, 'store']);
        Route::put('/update/{id}', [ShoppingCartController::class, 'update']);
        Route::delete('/remove/{id}', [ShoppingCartController::class, 'destroy']);
    });
*/

/////////////////

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('orders', 'orders')
    ->middleware(['auth'])
    ->name('orders');

require __DIR__.'/auth.php';
