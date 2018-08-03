<?php

namespace App\Http\Controllers\Communication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\StoreInfo;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Auth\User\UserBanner;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationType;
use App\Models\Communication\CommunicationDocument;
use App\Models\Communication\CommunicationPackage;
use App\Models\Tag\ContentTag;

class CommunicationManagerController extends Controller
{
    protected $user_id;
    protected $stores;
    protected $storeGroups;
    protected $banners;

    public function __construct()
    {
		
		
    }
    public function index(Request $request)
    {	
    
        $this->user_id = \Auth::user()->id;
        

        $storesByBanner = StoreInfo::getStoreListingByManagerId($this->user_id)->groupBy('banner_id');
        foreach ($storesByBanner as $key => $value) {
            $storesByBanner[$key] = $value->flatten()->pluck('store_number')->toArray();
        }

        $storeGroups = CustomStoreGroup::getStoreGroupsForManager($storesByBanner->flatten()->toArray());
        
        //$allCategoryCommunications are active or active+archived comm for storelist
        $allCategoryCommunications = Communication::getCommunicationsForStoreList($storesByBanner, $storeGroups, $request); 

        //filter communication if type is set
        $communications = Communication::filterAllCommunicationByCategory($allCategoryCommunications, $request); 
        
        $communicationTypes = CommunicationType::getCommunicationTypesByStorelist($allCategoryCommunications);

        $communicationCount = count($allCategoryCommunications);

        $title = Communication::getCommunicationCategoryName($request['type']);

        return view('manager.communications.index')
            ->with('communications', $communications)
            ->with('communicationTypes', $communicationTypes)
            ->with('communicationCount', $communicationCount)
            ->with('title', $title)
            ->with('archives', $request['archives']);
    }

    public function show($id, Request $request)
    {
        $this->user_id = \Auth::user()->id;
        
        $storesByBanner = StoreInfo::getStoreListingByManagerId($this->user_id)->groupBy('banner_id');
        foreach ($storesByBanner as $key => $value) {
            $storesByBanner[$key] = $value->flatten()->pluck('store_number')->toArray();
        }

        $storeGroups = CustomStoreGroup::getStoreGroupsForManager($storesByBanner->flatten()->toArray());

        //$allCategoryCommunications are active or active+archived comm for storelist
        $allCategoryCommunications = Communication::getCommunicationsForStoreList($storesByBanner, $storeGroups, $request); 
        
        $communicationTypes = CommunicationType::getCommunicationTypesByStorelist($allCategoryCommunications);

        $communicationCount = count($allCategoryCommunications);

        $communication          = Communication::getCommunicationById($id);

        $communicationPackages  = CommunicationPackage::getPackagesByCommunicationId($id);
        $communicationDocuments = CommunicationDocument::getDocumentsByCommunicationId($id);

        $tags = ContentTag::getTagsForContent("communication", $request->id);

        return view('manager.communications.message')
            ->with('communicationTypes', $communicationTypes)
            ->with('communicationCount', $communicationCount)
            ->with('communication', $communication)
            ->with('communication_documents', $communicationDocuments)
            ->with('communication_packages', $communicationPackages)
            ->with('tags', $tags);
    }
}
