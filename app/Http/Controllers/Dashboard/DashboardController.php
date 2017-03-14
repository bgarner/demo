<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\UserSelectedBanner;
use App\Models\Document\FileFolder;
use App\Models\Document\Package;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationDocument;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationTarget;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\Feature\Feature;
use App\Models\Dashboard\Quicklinks;
use App\Models\Dashboard\DashboardBranding;
use App\Models\Notification\Notification;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Alert\Alert;
use App\Skin;
use App\Models\StoreInfo;
use App\Models\Video\Video;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        // dd($request->all());
    	$storeNumber = RequestFacade::segment(1);

        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);

        $isComboStore = $storeInfo->is_combo_store;

        $storeBanner = $storeInfo->banner_id;

        $banner = Banner::find($storeBanner);

        $skin = Skin::getSkin($storeBanner);

        $features = Feature::getActiveFeatureByBannerId($storeBanner);

        $quicklinks = Quicklinks::getLinks($storeBanner, $storeNumber);

        $notifications = Notification::getAllNotifications($storeInfo->banner_id, $storeNumber, $banner->update_type_id, $banner->update_window_size);

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);

        $communicationCount = Communication::getActiveCommunicationCount($storeNumber);

        $alertCount = Alert::getActiveAlertCountByStore($storeNumber);

        $communications = Communication::getActiveCommunicationsByStoreNumber($storeNumber, 3);

        $featuredVideo = Video::getFeaturedVideo();

        return view('site.dashboard.index')
            ->with('banner', $banner)
            ->with('skin', $skin)
            ->with('quicklinks', $quicklinks)
        	->with('communicationCount', $communicationCount)
            ->with('alertCount', $alertCount)
            ->with('communications', $communications)
            ->with('features', $features)
            ->with('notifications', $notifications)
            ->with('urgentNoticeCount', $urgentNoticeCount)
            ->with('featuredVideo', $featuredVideo)
            ->with('isComboStore', $isComboStore);
    }


}
