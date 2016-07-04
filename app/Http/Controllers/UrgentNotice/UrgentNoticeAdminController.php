<?php

namespace App\Http\Controllers\UrgentNotice;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserSelectedBanner;
use App\Models\UserBanner;
use App\Models\Banner;
use App\Models\StoreInfo;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Document\FileFolder;
use App\Models\Document\FolderStructure;
use App\Models\UrgentNotice\UrgentNoticeAttachmentType;
use App\Models\UrgentNotice\UrgentNoticeAttachment;
use App\Models\UrgentNotice\UrgentNoticeTarget;
use App\Models\Document\Document;
use App\Models\Document\Folder;
use App\Models\UrgentNotice\UrgentNoticeDocument;
use App\Models\UrgentNotice\UrgentNoticeFolder;

class UrgentNoticeAdminController extends Controller
{
    
    /**
     * Instantiate a new UrgentNoticeAdminController instance.
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
    public function index()
    {
        // return view('admin.urgent-notice.index');

        $user_id = \Auth::user()->id;
        $banner_ids = UserBanner::where('user_id', $user_id)->get()->pluck('banner_id');
        $banners = Banner::whereIn('id', $banner_ids)->get();        
        $banner_id = UserSelectedBanner::where('user_id', \Auth::user()->id)->first()->selected_banner_id;
        $banner  = Banner::find($banner_id);

        $urgent_notices = UrgentNotice::where('banner_id', $banner->id)->get();
        return view('admin/urgent-notice/index')
                ->with('banner', $banner)
                ->with('banners',$banners)
                ->with('urgent_notices',$urgent_notices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();

        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $folderStructure = FolderStructure::getNavigationStructure($banner->id);

        $attachment_types = UrgentNoticeAttachmentType::all();

        $storeList = StoreInfo::getStoreListing($banner->id);
        
        // dd($fileFolderStructure);
        
        return view('admin.urgent-notice.create')
                    ->with('banner', $banner)
                    ->with('banners',$banners)
                    ->with('navigation', $fileFolderStructure)
                    ->with('folderStructure', $folderStructure)
                    ->with('attachment_types', $attachment_types)
                    ->with('storeList', $storeList);
        
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
        $banners = Banner::all();

        $urgent_notice = UrgentNotice::find($id);
        
        $attached_folders = [];
        $attached_documents = [];


        $attached_documents = UrgentNoticeDocument::join('documents', 'documents.id' ,'=', 'urgent_notice_documents.document_id')
                                                ->where('urgent_notice_id', $id)
                                                ->select('documents.*')
                                                ->get();

        $attached_folders = UrgentNoticeFolder::join('folder_ids', 'folder_ids.id' ,'=', 'urgent_notice_folders.folder_id')
                                                ->join('folders', 'folders.id', '=', 'folder_ids.folder_id')
                                                ->where('urgent_notice_id', $id)
                                                ->select('folders.*', 'folder_ids.id as global_folder_id')
                                                ->get();

        $storeList = StoreInfo::getStoreListing($banner->id);
        $target_stores = UrgentNoticeTarget::where('urgent_notice_id', $id)->get()->pluck('store_id')->toArray();
        $all_stores = false;
        if (count($storeList) == count($target_stores)) {
            $all_stores = true;
        }

        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $folderStructure = FolderStructure::getNavigationStructure($banner->id);
        
        $attachment_types = UrgentNoticeAttachmentType::all();
        
        return view('admin.urgent-notice.edit')->with('banners', $banners)
                                            ->with('banner', $banner)
                                            ->with('urgent_notice', $urgent_notice)
                                            ->with('attached_folders', $attached_folders)
                                            ->with('attached_documents', $attached_documents)
                                            ->with('target_stores', $target_stores)
                                            ->with('storeList', $storeList)
                                            ->with('all_stores', $all_stores)
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
        $documents = UrgentNoticeDocument::join('documents', 'documents.id', '=' ,'urgent_notice_documents.document_id')
                                        ->where('urgent_notice_documents.urgent_notice_id', $id)
                                        ->select('documents.*')
                                        ->get();
        return view('admin.urgent-notice.document-partial')->with('documents', $documents);
    }

    public function getFolderPartial($id)
    {
        $folders = UrgentNoticeFolder::join('folder_ids', 'folder_ids.id', '=' ,'urgent_notice_folders.folder_id')
                                        ->join('folders', 'folders.id', '=', 'folder_ids.folder_id')
                                        ->where('urgent_notice_folders.urgent_notice_id', $id)
                                        ->select('folders.*',  'folder_ids.id as global_folder_id')
                                        ->get();
        return view('admin.urgent-notice.folder-partial')->with('folders', $folders);
    }
}
