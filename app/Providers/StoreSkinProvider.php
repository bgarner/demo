<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class StoreSkinProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('site.includes.head', '\App\Http\ViewCreators\StoreSkinCreator');
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
