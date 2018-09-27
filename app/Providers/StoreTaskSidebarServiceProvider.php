<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class StoreTaskSidebarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('site.tasks.tasksidebar', '\App\Http\ViewCreators\StoreTaskSidebarCreator');
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
