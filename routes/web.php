<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Livewire\Volt\Volt;

Route::get('/', HomeController::class)
    ->name('home');

//checkout
Route::get('/checkout', CheckoutController::class)
    ->name('checkout');


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

//authentication
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

//shopping cart
Route::get('/cart', CartController::class)
    ->name('cart');

//products
Route::prefix('product')->group( function () {
    //Route::get('/search', [ProductController::class, 'search']);
    //Route::get('/', [ProductController::class, 'index']);       //
    Route::get('/{id}', [ProductController::class, 'show'])->name('show');   
});

//orders
Route::view('orders', 'orders')
    ->middleware(['auth'])
    ->name('orders');

require __DIR__.'/auth.php';
