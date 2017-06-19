<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Communication\Communication;
use App\Models\Feature\Feature;
use App\Models\Dashboard\Quicklinks;
use App\Models\Dashboard\DashboardBranding;
use App\Models\Notification\Notification;
use App\Models\StoreInfo;
use App\Models\Video\Video;
use App\Models\Video\FeaturedVideo;

class DashboardController extends Controller
{

    public function index(Request $request)
    {

    	$storeNumber = RequestFacade::segment(1);

        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);

        $storeBanner = $storeInfo->banner_id;

        $banner = Banner::find($storeBanner);

        $features = Feature::getActiveFeatureByBannerId($storeBanner);

        $quicklinks = Quicklinks::getLinks($storeBanner, $storeNumber);

        $notifications = Notification::getAllNotifications($storeInfo->banner_id, $storeNumber, $banner->update_type_id, $banner->update_window_size);

        $communications = Communication::getActiveCommunicationsByStoreNumber($storeNumber, 3);

        $featuredVideo = FeaturedVideo::getFeaturedVideoByBanner($storeBanner);

        return view('site.dashboard.index')
            ->with('banner', $banner)
            ->with('quicklinks', $quicklinks)
            ->with('communications', $communications)
            ->with('features', $features)
            ->with('notifications', $notifications)
            ->with('featuredVideo', $featuredVideo);
    }


}
