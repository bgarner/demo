<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Auth\Group\GroupComponent;

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
            $view->with('groupComponents', \App\Models\Auth\Group\GroupComponent::getAccessibleComponentNameList());
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
