<?php

namespace App\Http\Controllers\Communication;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\StoreInfo;
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
        
        $banner = UserSelectedBanner::getBanner();
        $communications = Communication::getAllCommunication($banner->id);
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
        $communicationTypes  = CommunicationType::where('banner_id', $banner->id)->get();
        
        $packages            = Package::where('banner_id',$banner->id)->get();
        $storeList           = StoreInfo::getStoreListing($banner->id);
        $storeGroups         = CustomStoreGroup::getAllGroups()->pluck('group_name', 'id')->toArray();
        // dd($storeGroups);
        // $storeList = array_merge($storeList, $storeGroups);
        $storeList = $storeList + $storeGroups;
        // dd($storeList);
        return view('admin.communication.create')
                                                ->with('storeList', $storeList)
                                                ->with('communicationTypes', $communicationTypes)
                                                ->with('navigation', $fileFolderStructure)
                                                ->with('packages', $packages)
                                                ->with('banner', $banner);
                                                

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
        $communicationTypes          = CommunicationType::where('banner_id', $banner->id)->get();
        
        $communication_target_stores = CommunicationTarget::where('communication_id', $id)->get()->pluck('store_id')->toArray();
        $storeList                   = StoreInfo::getStoreListing($banner->id);

        $fileFolderStructure         = FileFolder::getFileFolderStructure($banner->id);
        $packages                    = Package::where('banner_id', $banner->id)->get();

        return view('admin.communication.edit')->with('communication', $communication)
                                            ->with('communication_packages', $communication_packages)
                                            ->with('communication_documents', $communication_documents)
                                            ->with('communicationTypes', $communicationTypes)
                                            ->with('storeList', $storeList)
                                            ->with('navigation', $fileFolderStructure)
                                            ->with('packages', $packages)
                                            ->with('target_stores', $communication_target_stores)
                                            ->with('banner', $banner);
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
