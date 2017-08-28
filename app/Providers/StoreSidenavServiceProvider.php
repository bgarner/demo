<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class StoreSidenavServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('site.includes.sidenav', '\App\Http\ViewCreators\StoreSidenavCreator');
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
