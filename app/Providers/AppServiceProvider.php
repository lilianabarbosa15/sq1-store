<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ColorService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Traduction of the colors selected in each product.
        $this->app->singleton(ColorService::class, function ($app) {
            return new ColorService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }


}
