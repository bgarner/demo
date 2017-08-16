<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Auth\User\UserBanner;
use App\Models\StoreApi\Banner;

class AdminTopbarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.includes.topbar', function($view){

            $user_id = \Auth::user()->id;

            $banner_ids = UserBanner::where('user_id', $user_id)->get()->pluck('banner_id');
            $banners = Banner::whereIn('id', $banner_ids)->get();        
            $banner_id = UserSelectedBanner::where('user_id', \Auth::user()->id)->first()->selected_banner_id;
            $banner  = Banner::find($banner_id);

            $view->with('$user_id', $user_id)
            ->with('banner', $banner)
            ->with('banners', $banners);
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
