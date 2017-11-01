<?php

namespace App\Http\Controllers\Feature;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\StoreApi\Banner;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Feature\Feature;
use App\Models\Document\FileFolder;
use App\Models\Document\Package;
use App\Models\Document\Document;
use App\Models\Feature\FeatureDocument;
use App\Models\Feature\FeaturePackage;
use App\Models\Communication\CommunicationType;
use App\Models\Communication\Communication;
use App\Models\Feature\FeatureCommunicationTypes;
use App\Models\Feature\FeatureCommunication;
use App\Models\Feature\FeatureEventType;
use App\Models\Feature\FeatureEvent;
use App\Models\Feature\FeatureFlyer;
use App\Models\Flyer\Flyer;
use App\Models\Feature\FeatureTarget;
use App\Models\Utility\Utility;
use App\Models\Event\Event;
use App\Models\Event\EventType;
use App\Models\Task\Tasklist;
use App\Models\Feature\FeatureTasklist;

class FeatureAdminController extends Controller
{

    public function __construct()
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = UserSelectedBanner::getBanner();
        $features = Feature::getFeaturesForAdmin();
        
        return view('admin.feature.index')
                ->with('features', $features)
                ->with('banner', $banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner              = UserSelectedBanner::getBanner();
        $packages            = Package::where('banner_id', $banner->id)->get();
        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $communicationTypes  = CommunicationType::getCommunicationTypesForAdmin();
        $communicationTypes  = $communicationTypes->pluck('communication_type', 'id');
        $communications      = Communication::getCommunicationsForAdmin()->pluck('subject', 'id');
        $optGroupOptions     = Utility::getStoreAndBannerSelectDropdownOptions();
        $optGroupSelections  = json_encode([]);
        $flyers              = Flyer::getFlyersByBannerId($banner->id);

        $eventTypes          = EventType::getEventTypesForAdmin();
        $eventTypes          = $eventTypes->pluck('event_type', 'id')->toArray();

        $events              = Event::getEventsForAdmin()->pluck('title', 'id')->toArray();
        $tasklists           = Tasklist::getTasklistsForAdmin()->pluck('title', 'id')->toArray();

        return view('admin.feature.create')
                ->with('banner', $banner)
                ->with('navigation', $fileFolderStructure)
                ->with('packages', $packages)
                ->with('communicationTypes', $communicationTypes)
                ->with('communications', $communications)
                ->with('optGroupOptions', $optGroupOptions)
                ->with('optGroupSelections', $optGroupSelections)
                ->with('flyers', $flyers)
                ->with('events', $events)
                ->with('eventTypes', $eventTypes)
                ->with('tasklists', $tasklists);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Feature::storeFeature($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner                       = UserSelectedBanner::getBanner();
        $feature                      = Feature::find($id);

        $fileFolderStructure          = FileFolder::getFileFolderStructure($banner->id);
        $selected_documents           = FeatureDocument::getDocumentByFeatureId($id);

        $packages                     = Package::where('banner_id', $banner->id)->get();
        $selected_packages            = FeaturePackage::getPackageByFeatureId($id);
        
        $communicationTypes           = CommunicationType::getCommunicationTypesForAdmin();
        $communicationTypes           = $communicationTypes->pluck('communication_type', 'id');
        $selected_communication_types = FeatureCommunicationTypes::getCommunicationTypeId($id);
        
        $communications               = Communication::getCommunicationsForAdmin()->pluck('subject', 'id');
        $selected_communications      = FeatureCommunication::getCommunicationId($id);

        $optGroupOptions              = Utility::getStoreAndBannerSelectDropdownOptions();
        $optGroupSelections           = json_encode(Feature::getSelectedStoresAndBannersByFeatureId($id));

        $flyers                       = Flyer::getFlyersByBannerId($banner->id);
        $selected_flyers              = FeatureFlyer::getFlyersByFeatureId($id);

        $eventTypes                   = EventType::getEventTypesForAdmin();
        $eventTypes                   = $eventTypes->pluck('event_type', 'id')->toArray();
        $selected_event_types         = FeatureEventType::getEventTypeId($id);

        $events                       = Event::getEventsForAdmin()->pluck('title', 'id')->toArray();
        $selected_events              = FeatureEvent::getEventId($id);

        $tasklists                    = Tasklist::getTasklistsForAdmin()->pluck('title', 'id')->toArray();
        $selected_tasklists           = FeatureTasklist::getTasklistsByFeatureId($id);

        return view('admin.feature.edit')->with('feature', $feature)
                                    
                                        ->with('banner', $banner)
                                        ->with('navigation', $fileFolderStructure)
                                        ->with('feature_documents', $selected_documents )
                                        ->with('packages', $packages)
                                        ->with('feature_packages', $selected_packages)
                                        ->with('communicationTypes', $communicationTypes)
                                        ->with('selected_communication_types', $selected_communication_types)
                                        ->with('communications', $communications)
                                        ->with('selected_communications', $selected_communications)
                                        ->with('optGroupOptions', $optGroupOptions)
                                        ->with('optGroupSelections', $optGroupSelections)
                                        ->with('flyers', $flyers)
                                        ->with('feature_flyers', $selected_flyers)
                                        ->with('eventTypes', $eventTypes)
                                        ->with('selected_event_types', $selected_event_types)
                                        ->with('events', $events)
                                        ->with('selected_events', $selected_events)
                                        ->with('tasklists', $tasklists)
                                        ->with('selected_tasklists', $selected_tasklists);
                                        
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
        return Feature::updateFeature($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Feature::deleteFeature($id);
        return;
    }

    public function getFeatureDocumentPartial($feature_id)
    {
        $documents = FeatureDocument::getDocumentByFeatureId($feature_id);
        return view('admin.feature.feature-documents-partial')->with('documents', $documents);
    }

    public function getFeaturePackagePartial($feature_id)
    {
        $packages = FeaturePackage::getPackageByFeatureId($feature_id);

        return view('admin.feature.feature-packages-partial')->with('packages', $packages);
    }

    public function getFeatureFlyerPartial($feature_id)
    {
        $flyers = FeatureFlyer::getFlyersByFeatureId($feature_id);

        return view('admin.feature.feature-flyers-partial')->with('flyers', $flyers);
    }
}
