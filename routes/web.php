<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrdersController;
use Livewire\Volt\Volt;

Route::get('/', HomeController::class)
    ->name('home');

//checkout
Route::get('/checkout', CheckoutController::class)
    ->name('checkout');

//
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
    Route::get('/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show'])->name('show');   
});

//orders
Route::get('orders', OrdersController::class)
        ->middleware(['auth'])
        ->name('orders');


require __DIR__.'/auth.php';
