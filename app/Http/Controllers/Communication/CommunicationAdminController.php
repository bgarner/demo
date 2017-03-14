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
use App\Models\UserSelectedBanner;
use App\Models\Communication\CommunicationTarget;

class CommunicationAdminController extends Controller
{
    
    /**
     * Instantiate a new CommunicationAdminController instance.
     */
    public function __construct()
    {
        $this->middleware('admin.auth');
        $this->middleware('banner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        $communications = Communication::getAllCommunication($banner->id);
        return view('admin.communication.index')->with('communications', $communications)
                                                ->with('banner', $banner)
                                                ->with('banners', $banners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $communicationTypes = CommunicationType::where('banner_id', $banner->id)->get();
        
        $packages = Package::where('banner_id',$banner->id)->get();
        $storeList = StoreInfo::getStoreListing($banner->id);
        return view('admin.communication.create')->with('banner', $banner)
                                                ->with('storeList', $storeList)
                                                ->with('communicationTypes', $communicationTypes)
                                                ->with('banners', $banners)
                                                ->with('navigation', $fileFolderStructure)
                                                ->with('packages', $packages);
                                                

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
        
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();

        $communication = Communication::find($id);
        $communication_documents  = Communication::getDocumentDetails($id);
        $communication_packages  = Communication::getPackageDetails($id);
        $importance = \DB::table('communication_importance_levels')->lists('name', 'id');

        return view('admin.communication.view')->with('communication', $communication)
                                            ->with('communication_packages', $communication_packages)
                                            ->with('communication_documents', $communication_documents)
                                            ->with('importance', $importance)
                                            ->with('banner', $banner)
                                            ->with('banners', $banners)
                                            ->with('tags', $tags)
                                            ->with('selected_tags', $selected_tags);
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
        $banners = Banner::all();

        $communication = Communication::find($id);
        $communication_documents  = Communication::getDocumentDetails($id);
        $communication_packages  = Communication::getPackageDetails($id);
        $communicationTypes = CommunicationType::where('banner_id', $banner->id)->get();
        
        $communication_target_stores = CommunicationTarget::where('communication_id', $id)->get()->pluck('store_id')->toArray();
        $storeList = StoreInfo::getStoreListing($banner->id);
        $all_stores = false;
        if (count($storeList) == count($communication_target_stores)) {
            $all_stores = true;
        }

        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $packages = Package::where('banner_id', $banner->id)->get();

        return view('admin.communication.edit')->with('communication', $communication)
                                            ->with('communication_packages', $communication_packages)
                                            ->with('communication_documents', $communication_documents)
                                            ->with('communicationTypes', $communicationTypes)
                                            ->with('banner', $banner)
                                            ->with('storeList', $storeList)
                                            ->with('banners', $banners)
                                            ->with('navigation', $fileFolderStructure)
                                            ->with('packages', $packages)
                                            ->with('target_stores', $communication_target_stores)
                                            ->with('all_stores', $all_stores);
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
