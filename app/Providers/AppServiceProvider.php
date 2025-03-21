<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Use Bootstrap for pagination
        Paginator::useBootstrap();
        
        // Comment out custom pagination views until they are created
        // Paginator::defaultView('pagination.custom');
        // Paginator::defaultSimpleView('pagination.simple-custom');
    }
}
