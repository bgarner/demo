<?php

namespace App\Http\Controllers\Feature;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Feature\Feature;
use App\Models\Notification\Notification;
use App\Models\Feature\FeatureDocument;
use App\Models\Feature\FeaturePackage;
use App\Models\Feature\FeatureFlyer;
use App\Models\Feature\FeatureEvent;
use App\Models\Feature\FeatureCommunication;
use App\Models\Feature\FeatureTasklist;

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
        $storeNumber                  = RequestFacade::segment(1);
        $id                           = $request->id;
        $feature                      = Feature::where('id', $id)->first();
        $selected_documents           = FeatureDocument::getFeaturedDocuments($feature->id, $storeNumber);
        $selected_packages            = FeaturePackage::getFeaturePackages($feature->id);
        $feature_communications       = FeatureCommunication::getFeatureCommunications($feature->id, $storeNumber);
        $notifications                = Notification::getNotificationsByFeature($feature->id, $storeNumber);
        $flyers = FeatureFlyer::getFlyersByFeatureId($feature->id);
        $events = FeatureEvent::getEventsByFeatureId($feature->id);
        $tasklists = FeatureTasklist::getTasklistsByFeatureId($feature->id);

        return view('site.feature.index')
			->with('notifications', $notifications)
            ->with('feature', $feature)
            ->with('feature_documents', $selected_documents)
            ->with('feature_packages', $selected_packages)
            ->with('feature_communications', $feature_communications)
            ->with('flyers', $flyers)
            ->with('events', $events)
            ->with('tasklists', $tasklists);
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
