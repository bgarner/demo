<?php

namespace App\Http\Controllers\Communication;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Banner;
use App\Models\AtoreApi\StoreInfo;
use App\Models\Document\FileFolder;
use App\Models\Document\Package;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationDocument;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationType;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Communication\CommunicationTarget;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Utility\Utility;

class CommunicationAdminController extends Controller
{
    /**
     * Instantiate a new CommunicationAdminController instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $communications = Communication::getCommunicationsForAdmin();
        
        return view('admin.communication.index')->with('communications', $communications);
                                                
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $banner              = UserSelectedBanner::getBanner();
        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $communicationTypes  = CommunicationType::getCommunicationTypesForAdmin();
        
        $packages            = Package::where('banner_id',$banner->id)->get();

        $optGroupOptions     = Utility::getStoreAndBannerSelectDropdownOptions();
        $optGroupSelections  = json_encode([]);

        $tags = Tag::all()->pluck('name', 'id'); 
        $selected_tags = [];

        return view('admin.communication.create')
                                                ->with('optGroupSelections', $optGroupSelections)
                                                ->with('optGroupOptions', $optGroupOptions)
                                                ->with('communicationTypes', $communicationTypes)
                                                ->with('navigation', $fileFolderStructure)
                                                ->with('packages', $packages)
                                                ->with('banner', $banner)
                                                ->with('tags', $tags)
                                                ->with('selected_tags', $selected_tags);
                                                

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Communication::storeCommunication($request);         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $communication           = Communication::find($id);
        $communication_documents = CommunicationDocument::getDocumentsByCommunicationId($id);
        $communication_packages  = CommunicationPackage::getPackagesByCommunicationId($id);
        $importance              = \DB::table('communication_importance_levels')->pluck('name', 'id');

        return view('admin.communication.view')->with('communication', $communication)
                                            ->with('communication_packages', $communication_packages)
                                            ->with('communication_documents', $communication_documents);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $banner = UserSelectedBanner::getBanner();

        $communication               = Communication::find($id);
        $communication_documents     = CommunicationDocument::getDocumentsByCommunicationId($id);
        $communication_packages      = CommunicationPackage::getPackagesByCommunicationId($id);
        $communicationTypes          = CommunicationType::getCommunicationTypesForAdmin();

        $optGroupOptions             = Utility::getStoreAndBannerSelectDropdownOptions();
        $optGroupSelections          = json_encode(Communication::getSelectedStoresAndBannersByCommunicationId($id));

        $fileFolderStructure         = FileFolder::getFileFolderStructure($banner->id);
        $packages                    = Package::where('banner_id', $banner->id)->get();

        $tags                        = Tag::all()->pluck('name', 'id');
        $selectedTags                = ContentTag::getTagsByContentId('communication', $id);

        return view('admin.communication.edit')->with('communication', $communication)
                                            ->with('communication_packages', $communication_packages)
                                            ->with('communication_documents', $communication_documents)
                                            ->with('communicationTypes', $communicationTypes)
                                            ->with('navigation', $fileFolderStructure)
                                            ->with('packages', $packages)
                                            ->with('optGroupOptions', $optGroupOptions)
                                            ->with('optGroupSelections', $optGroupSelections)
                                            ->with('banner', $banner)
                                            ->with('tags', $tags)
                                            ->with('selectedTags', $selectedTags)
                                            ->with('resourceId', $id);
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
        return Communication::updateCommunication($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Communication::deleteCommunication($id);
        return;

    }
}
