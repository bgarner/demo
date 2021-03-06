<?php

namespace App\Http\Controllers\UrgentNotice;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Auth\User\UserBanner;
use App\Models\StoreApi\Banner;
use App\Models\StoreApi\StoreInfo;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Document\FileFolder;
use App\Models\Document\FolderStructure;
use App\Models\UrgentNotice\UrgentNoticeAttachmentType;
use App\Models\UrgentNotice\UrgentNoticeTarget;
use App\Models\Document\Document;
use App\Models\Document\Folder;
use App\Models\UrgentNotice\UrgentNoticeDocument;
use App\Models\UrgentNotice\UrgentNoticeFolder;
use App\Models\Utility\Utility;

class UrgentNoticeAdminController extends Controller
{
    
    /**
     * Instantiate a new UrgentNoticeAdminController instance.
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
    public function index()
    {
       
        $banner = UserSelectedBanner::getBanner();

        $urgent_notices = UrgentNotice::getUrgentNoticeForAdmin();
        return view('admin.urgent-notice.index')->with('urgent_notices',$urgent_notices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $banner = UserSelectedBanner::getBanner();

        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $folderStructure = FolderStructure::getNavigationStructure($banner->id);

        $attachment_types = UrgentNoticeAttachmentType::all();

        $optGroupOptions    = Utility::getStoreAndBannerSelectDropdownOptions();
        $optGroupSelections = json_encode([]);
        
        return view('admin.urgent-notice.create')
                    ->with('banner', $banner)
                    ->with('navigation', $fileFolderStructure)
                    ->with('folderStructure', $folderStructure)
                    ->with('attachment_types', $attachment_types)
                    ->with('optGroupSelections', $optGroupSelections)
                    ->with('optGroupOptions', $optGroupOptions);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return UrgentNotice::storeUrgentNotice($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $banner = UserSelectedBanner::getBanner();

        $urgent_notice = UrgentNotice::find($id);
        
        $attached_folders = [];
        $attached_documents = [];

        $attached_documents = UrgentNoticeDocument::getDocuments($id);
        $attached_folders = UrgentNoticeFolder::getFolders($id);

        $optGroupOptions    = Utility::getStoreAndBannerSelectDropdownOptions();
        $optGroupSelections = json_encode(UrgentNotice::getSelectedStoresAndBannersByUrgentNoticeId($id));
        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $folderStructure = FolderStructure::getNavigationStructure($banner->id);
        
        $attachment_types = UrgentNoticeAttachmentType::all();
        
        return view('admin.urgent-notice.edit')->with('banner', $banner)
                                            ->with('urgent_notice', $urgent_notice)
                                            ->with('attached_folders', $attached_folders)
                                            ->with('attached_documents', $attached_documents)
                                            ->with('optGroupOptions', $optGroupOptions)
                                            ->with('optGroupSelections', $optGroupSelections)
                                            ->with('navigation', $fileFolderStructure)
                                            ->with('folderStructure', $folderStructure);
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
        return UrgentNotice::updateUrgentNotice($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return UrgentNotice::deleteUrgentNotice($id);
    }

    public function getDocumentPartial($id)
    {
        $documents = UrgentNoticeDocument::getDocuments($id);
        return view('admin.urgent-notice.document-partial')->with('documents', $documents);
    }

    public function getFolderPartial($id)
    {
        $folders = UrgentNoticeFolder::getFolders($id);
        return view('admin.urgent-notice.folder-partial')->with('folders', $folders);
    }
}
