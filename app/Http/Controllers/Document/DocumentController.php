<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Document\Folder;
use App\Models\Document\FolderStructure;
use App\Models\Document\Week;
use App\Models\Document\FileFolder;
use App\Models\Document\Document;
use App\Models\Banner;
use App\Models\Document\Package;
use App\Skin;
use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationDocument;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationTarget;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Alert\Alert;
use App\Models\StoreInfo;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $storeNumber = RequestFacade::segment(1);

        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);

        $storeBanner = $storeInfo->banner_id;

        $banner = Banner::find($storeBanner);

        $isComboStore = $storeInfo->is_combo_store;

        $skin = Skin::getSkin($storeBanner);

        $communicationCount = DB::table('communications_target')
            ->where('store_id', $storeNumber)
            ->whereNull('is_read')
            ->count();        

        
        $banner = Banner::where('id', $storeBanner)->first();

        $navigation = FolderStructure::getNavigationStructure($banner->id);

        $folders = Folder::all();

        $defaultFolder = $request->get('parent');

        if (!isset($defaultFolder)) {
            $defaultFolder = null;
        }

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);

        $alertCount = Alert::getActiveAlertCountByStore($storeNumber);        
        
        return view('site.documents.index')
            ->with('skin', $skin)
            ->with('navigation', $navigation)
            ->with('folders', $folders)
            ->with('banner', $banner)
            ->with('communicationCount', $communicationCount)
            ->with('alertCount', $alertCount)
            ->with('defaultFolder' , $defaultFolder)
            ->with('urgentNoticeCount', $urgentNoticeCount)
            ->with('banner', $banner)
            ->with('isComboStore', $isComboStore);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
