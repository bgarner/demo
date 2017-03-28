<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class StoreTopbarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('site.includes.topbar', '\App\Http\ViewCreators\StoreTopbarCreator');
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
