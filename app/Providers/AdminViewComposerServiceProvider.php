<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Auth\Role\RoleComponent;

class AdminViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.includes.sidenav', function($view){
            $view->with('roleComponents', \App\Models\Auth\Role\RoleComponent::getAccessibleComponentNameList());
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
