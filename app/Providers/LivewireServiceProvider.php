<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Livewire::setScriptRoute(function ($handle) {
        //     return Route::get('/ecommerce/livewire/livewire.min.js', $handle);
        // });
        //
        // Livewire::setUpdateRoute(function ($handle) {
        //     return Route::post('/ecommerce/livewire/update', $handle)
        //         ->middleware(['web']);
        // });
    }
}
