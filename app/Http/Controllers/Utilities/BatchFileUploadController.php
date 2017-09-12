<?php

namespace App\Http\Controllers\Utilities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Document\Document;
use App\Models\Document\Folder;
use App\Models\Document\FileFolder;
use App\Models\Document\FolderStructure;
use App\Models\StoreApi\Banner;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\StoreApi\StoreInfo;
use App\Models\Alert\Alert;
use App\Models\Document\DocumentTarget;
use App\Models\Utility\Utility;

class BatchFileUploadController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $folder_id          = $request->get('folder');
        $documents          = Document::getDocuments($folder_id);
        $folder             = Folder::getFolderDescription($folder_id);
        $response           = [];
        $response["files"]  = $documents;
        $response["folder"] = $folder;
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $banner      = UserSelectedBanner::getBanner();
        $banners     = Banner::all();
        // $storeList   = StoreInfo::getStoreListing($banner->id);
        $storeAndStoreGroups = Utility::getStoreAndStoreGroupList($banner->id);
        $packageHash = sha1(time() . time());
        $folders     = Folder::all();
        return view('admin.documentmanager.document-upload')
            ->with('folders', $folders)
            ->with('packageHash', $packageHash)
            ->with('banner', $banner)
            ->with('storeAndStoreGroups', $storeAndStoreGroups)
            ->with('banners', $banners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        Document::storeDocument($request);
    }
}
