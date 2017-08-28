<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Request as RequestFacade;
use App\Models\StoreApi\StoreInfo;
use App\Models\StoreApi\Banner;
use Closure, Session, Config, App;

class UserBanner
{
    public $attributes;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $storeNumber = RequestFacade::segment(1);
        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);
        $storeBanner = $storeInfo->banner_id;
        $banner = Banner::find($storeBanner);
        
        Session::flash('banner', $banner);
        Session::flash('storeInfo', $storeInfo);

        $request->attributes->add(['store_number' => $storeInfo->store_number]);
        $request->attributes->add(['store_name' => $storeInfo->name]);
        $request->attributes->add(['store_banner' => $banner->title]);
        //$request->attributes->add(['banner' => $banner]);

        return $next($request);
    }
}
