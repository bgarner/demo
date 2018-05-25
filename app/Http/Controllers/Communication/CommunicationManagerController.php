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
	    
        $storeList = StoreInfo::getStoreListingByManagerId($this->user_id);
        $this->stores = array_column($storeList, 'store_number');
        $this->storeGroups = CustomStoreGroup::getStoreGroupsForManager($this->user_id);

        $this->banners = UserBanner::getAllBanners()->pluck( 'id');

        // $communicationTypes = CommunicationType::getCommunicationTypesByStoreNumber($request, $storeNumber);

        $communications = Communication::getCommunicationsForStoreList($this->stores, $this->banners, $this->storeGroups, $request);

        $title = Communication::getCommunicationCategoryName($request['type']);

        $communicationCount = count($communications);

        return view('manager.communications.index')
            ->with('communications', $communications)
            ->with('communicationCount', $communicationCount)
            ->with('title', $title)
            ->with('archives', $request['archives']);
    }

    public function show($id, Request $request)
    {

        // $communicationTypes     = CommunicationType::getCommunicationTypesByStoreNumber($request, $storeNumber);

        // $communicationCount     = Communication::getCommunicationCountByStoreNumber($request, $storeNumber);
        $communicationCount     = 3;

        $communication          = Communication::getCommunicationById($id);

        $communicationPackages  = CommunicationPackage::getPackagesByCommunicationId($id);
        $communicationDocuments = CommunicationDocument::getDocumentsByCommunicationId($id);

        $request->request->add(['archives' => false]);
        // $communications         = Communication::getCommunicationByStoreNumber($request, $storeNumber);

        // $communication->nextCommunicationId = Communication::getNextCommunication($communications, $communication);
        // $communication->previousCommunicationId = Communication::getPreviousCommunication($communications, $communication);
        $tags = ContentTag::getTagsForContent("communication", $request->id);

        return view('manager.communications.message')
            // ->with('communicationTypes', $communicationTypes)
            ->with('communicationCount', $communicationCount)
            ->with('communication', $communication)
            ->with('communication_documents', $communicationDocuments)
            ->with('communication_packages', $communicationPackages)
            ->with('tags', $tags);
    }
}
