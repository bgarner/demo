<?php

namespace App\Http\Controllers\UrgentNotice;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Skin;
use App\Models\Banner;
use App\Models\StoreInfo;
use App\Models\Communication\Communication;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\UrgentNotice\UrgentNoticeAttachmentType;
use App\Models\UrgentNotice\UrgentNoticeAttachment;
use App\Models\UrgentNotice\UrgentNoticeTarget;
use App\Models\Document\Document;
use App\Models\Document\Folder;
use App\Models\Utility\Utility;

class UrgentNoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storeNumber = RequestFacade::segment(1);
        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);
        $storeBanner = $storeInfo->banner_id;
        $banner = Banner::find($storeBanner);
        $isComboStore = $storeInfo->is_combo_store;
        $skin = Skin::getSkin($storeBanner);

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);
        $urgentNotices = UrgentNotice::getActiveUrgentNoticesByStore($storeNumber);

        return view('site.urgentnotices.index')
            ->with('skin', $skin)
            ->with('urgentNoticeCount', $urgentNoticeCount)
            ->with('notices', $urgentNotices)
            ->with('banner', $banner)
            ->with('isComboStore', $isComboStore);      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sn, $id)
    {
        $storeNumber = RequestFacade::segment(1);
        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);
        $storeBanner = $storeInfo->banner_id;
        $banner = Banner::find($storeBanner);
        $isComboStore = $storeInfo->is_combo_store;

        $skin = Skin::getSkin($storeBanner);

        $communicationCount = Communication::getActiveCommunicationCount($storeNumber); 

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);

        $notice = UrgentNotice::getUrgentNotice($id);

        $attachment_types = UrgentNoticeAttachmentType::all();

        $urgent_notice_attachment_ids = UrgentNoticeAttachment::where('urgent_notice_id', $id)->get()->pluck('attachment_id');

        $attached_folders = [];
        $attached_documents = [];

        if ($notice->attachment_type_id == 1) { //folder
            
            foreach ($urgent_notice_attachment_ids as $key=>$global_folder_id) {
                $folder_id = \DB::table('folder_ids')->where('id', $global_folder_id)->first()->folder_id;
                $folder = Folder::find($folder_id);
                $folder->global_folder_id = $global_folder_id;

                $folder->since = Utility::getTimePastSinceDate($folder->updated_at);
                $folder->prettyDate = Utility::prettifyDate($folder->updated_at);

                array_push($attached_folders, $folder);
                unset($folder);
            }
        }
        else if ($notice->attachment_type_id == 2 ) { //document
            
            foreach ($urgent_notice_attachment_ids as $document_id) {
                
                $document = Document::find($document_id);

                $document->link = Utility::getModalLink($document->filename, $document->title, $document->original_extension, $document->id, 0);
                $document->link_with_icon = Utility::getModalLink($document->filename, $document->title, $document->original_extension, $document->id, 1);
                $document->anchor_only =  Utility::getModalLink($document->filename, $document->title, $document->original_extension, $document->id, 1, 1);
                $document->icon = Utility::getIcon($document->original_extension);

                array_push($attached_documents, $document);
                unset($document);
            }
        } 

         foreach($attached_documents as $doc){
            
            $doc->since = Utility::getTimePastSinceDate($doc->updated_at);
            $doc->prettyDate =  Utility::prettifyDate($doc->updated_at);
         }
         
        return view('site.urgentnotices.notice')
            ->with('skin', $skin)
            ->with('notice', $notice)
            ->with('communicationCount', $communicationCount)
            ->with('urgentNoticeCount', $urgentNoticeCount)
            ->with('attached_folders', $attached_folders)
            ->with('attached_documents', $attached_documents)
            ->with('attachment_types', $attachment_types)
            ->with('banner', $banner)
            ->with('isComboStore', $isComboStore);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
