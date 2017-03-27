<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminSidenavServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.includes.sidenav', '\App\Http\ViewCreators\AdminSidenavCreator');
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
