<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FormUserSidenavServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('formuser.includes.sidenav', function($view){

            $role = preg_replace("/\s+/", "", \Auth::user()->role);

            $view->with('role', $role);
            
        });
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
