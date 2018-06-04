<?php

namespace App\Http\Controllers\UrgentNotice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\StoreInfo;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Auth\User\UserBanner;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\UrgentNotice\UrgentNoticeDocument;
use App\Models\UrgentNotice\UrgentNoticeFolder;
use App\Models\UrgentNotice\UrgentNoticeAttachmentType;

class UrgentNoticeManagerController extends Controller
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
        $this->storeGroups = CustomStoreGroup::getStoreGroupsForManager($this->stores);

        $this->banners = UserBanner::getAllBanners()->pluck( 'id');

    	$urgentNotices = UrgentNotice::getActiveUrgentNoticesForStoreList($this->stores, $this->banners, $this->storeGroups);

        return view('manager.urgentnotice.index')->with('urgentNotices', $urgentNotices);

    } 

    public function show($id)
    {

        $notice = UrgentNotice::getUrgentNotice($id);

        $attachment_types = UrgentNoticeAttachmentType::all();

        $attached_documents = UrgentNoticeDocument::getDocuments($id);

        $attached_folders = UrgentNoticeFolder::getFolders($id);

        return view('manager.urgentnotice.notice')
            ->with('notice', $notice)
            ->with('attached_folders', $attached_folders)
            ->with('attached_documents', $attached_documents)
            ->with('attachment_types', $attachment_types);
    }
}
