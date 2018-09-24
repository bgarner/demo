<?php

namespace App\Http\Controllers\Feature;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use App\Http\Controllers\Controller;
use App\Models\Feature\Feature;
use App\Models\Feature\FeatureDocument;
use App\Models\Feature\FeaturePackage;
use App\Models\Feature\FeatureFlyer;
use App\Models\Feature\FeatureEvent;
use App\Models\Feature\FeatureCommunication;
use App\Models\Communication\Communication;
use App\Models\Document\Package;
use App\Models\Feature\FeatureTasklist;
use App\Models\StoreApi\StoreInfo;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Auth\User\UserBanner;

class FeatureManagerController extends Controller
{
    public function show($id)
    {

		$user_id                = \Auth::user()->id;
		$storesByBanner 		= StoreInfo::getStoreListingByManagerId($user_id)->groupBy('banner_id');
        foreach ($storesByBanner as $key => $value) {
            $storesByBanner[$key] = $value->flatten()->pluck('store_number')->toArray();
        }

		$storeGroups 			= CustomStoreGroup::getStoreGroupsForManager($storesByBanner->flatten()->toArray());
		
		$feature                = Feature::where('id', $id)->first();
		
		$selected_documents  	= FeatureDocument::getFeaturedDocumentsByStoreList($storesByBanner, $storeGroups,$feature->id);

		$selected_packages      = FeaturePackage::getFeaturePackages($feature->id);

		$feature_communications = FeatureCommunication::getFeatureCommunicationsForStoreList($storesByBanner, $storeGroups, $feature->id);
		
		$flyers                 = FeatureFlyer::getFlyersByFeatureId($feature->id);
		$events                 = FeatureEvent::getEventsByFeatureId($feature->id);
		$tasklists              = FeatureTasklist::getTasklistsByFeatureIdForAdmin($feature->id);

        return view('manager.feature.message')
            ->with('feature', $feature)
            ->with('feature_documents', $selected_documents)
            ->with('feature_packages', $selected_packages)
            ->with('feature_communications', $feature_communications)
            ->with('flyers', $flyers)
            ->with('events', $events)
            ->with('tasklists', $tasklists);
	
    }
}
