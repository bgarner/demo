<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\StoreApi\StoreInfo;
use App\Models\Auth\User\UserBanner;
use App\Models\Tools\CustomStoreGroup;
use App\Models\UrgentNotice\UrgentNotice;

class ManagerSidenavServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('manager.includes.nav', function($view){

        $user_id = \Auth::user()->id;
        
        $storeList = StoreInfo::getStoreListingByManagerId($user_id);
        $stores = $storeList->pluck('store_number')->toArray();
        
        $storeGroups = CustomStoreGroup::getStoreGroupsForManager($stores);

        $banners = UserBanner::getAllBanners()->pluck( 'id');           

        $urgentNoticeCount = count(UrgentNotice::getActiveUrgentNoticesForStoreList($stores, $banners, $storeGroups));
        
        $view->with('urgentNoticeCount', $urgentNoticeCount);
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
