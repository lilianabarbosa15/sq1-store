<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')
        ->name('register');                         ////////////////////

    Volt::route('login', 'pages.auth.login')
        ->name('login');                            ////////////////////

    Volt::route('forgot-password', 'pages.auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'pages.auth.reset-password')
        ->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'pages.auth.confirm-password')
        ->name('password.confirm');
});



/*
//authentication
Route::prefix('custom')->group( function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register'); //POST
    Route::post('/login', [AuthController::class, 'login'])->name('login');         //POST
    
    //Route::middleware('auth:sanctum')->get('profile', [AuthController::class, 'profile'])->name('profile');
    //Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});




originals:
//authentication
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::middleware('auth:sanctum')->get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

*/