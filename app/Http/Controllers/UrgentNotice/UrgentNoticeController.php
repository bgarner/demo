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
use App\Models\UrgentNotice\UrgentNoticeTarget;
use App\Models\Document\Document;
use App\Models\Document\Folder;
use App\Models\Utility\Utility;
use App\Models\UrgentNotice\UrgentNoticeDocument;
use App\Models\UrgentNotice\UrgentNoticeFolder;


class UrgentNoticeController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storeNumber = RequestFacade::segment(1);

        $urgentNotices = UrgentNotice::getActiveUrgentNoticesByStore($storeNumber);

        return view('site.urgentnotices.index')
            ->with('notices', $urgentNotices);      
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

        $notice = UrgentNotice::getUrgentNotice($id);

        $attachment_types = UrgentNoticeAttachmentType::all();

        $attached_documents = UrgentNoticeDocument::getDocuments($id);

        $attached_folders = UrgentNoticeFolder::getFolders($id);

        return view('site.urgentnotices.notice')
            ->with('notice', $notice)
            ->with('attached_folders', $attached_folders)
            ->with('attached_documents', $attached_documents)
            ->with('attachment_types', $attachment_types);
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
