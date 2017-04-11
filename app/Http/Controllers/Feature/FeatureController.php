<?php

namespace App\Http\Controllers\Feature;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Feature\Feature;
use App\Models\Notification\Notification;
use App\Skin;
use App\Models\Feature\FeatureDocument;
use App\Models\Feature\FeaturePackage;
use App\Models\Feature\FeatureFlyer;
use App\Models\Feature\FeatureCommunication;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationTarget;
use App\Models\Document\Document;
use App\Models\Document\Package;
use App\Models\StoreInfo;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Alert\Alert;
use App\Models\Utility\Utility;
use App\Models\Banner;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $storeNumber = RequestFacade::segment(1);

        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);

        $alertCount = Alert::getActiveAlertCountByStore($storeNumber);

        $communicationCount = Communication::getActiveCommunicationCount($storeNumber);

        $storeBanner = $storeInfo->banner_id;

        $banner = Banner::find($storeBanner);

        $isComboStore = $storeInfo->is_combo_store;

        $skin = Skin::getSkin($storeBanner);

        $id = $request->id;

        $feature = Feature::where('id', $id)->first();

        $selected_documents = FeatureDocument::getFeaturedDocuments($feature->id, $storeNumber);

        $selected_packages = FeaturePackage::getFeaturePackages($feature->id);

        $feature_communcation_type_id = FeatureCommunication::getCommunicationTypeId($id);

        $feature_communcations = CommunicationTarget::getTargetedCommunicationsByCategory($storeNumber, $feature_communcation_type_id);

        $flyers = FeatureFlyer::getFlyersByFeatureId($feature->id);

		$notifications = Notification::getNotificationsByFeature($feature->id, $storeNumber);

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);

        return view('site.feature.index')
            ->with('skin', $skin)
            ->with('urgentNoticeCount', $urgentNoticeCount)
			->with('notifications', $notifications)
            ->with('communicationCount', $communicationCount)
            ->with('alertCount', $alertCount)
            ->with('feature', $feature)
            ->with('feature_documents', $selected_documents)
            ->with('feature_packages', $selected_packages)
            ->with('feature_communcations', $feature_communcations)
            ->with('urgentNoticeCount', $urgentNoticeCount)
            ->with('banner', $banner)
            ->with('flyers', $flyers)
            ->with('isComboStore', $isComboStore);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
