<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class StoreFooterProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('site.includes.footer', '\App\Http\ViewCreators\StoreFooterCreator');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
