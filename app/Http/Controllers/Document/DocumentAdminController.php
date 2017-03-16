<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Document\Document;
use App\Models\Document\Folder;
use App\Models\Document\FileFolder;
use App\Models\Document\FolderStructure;
use App\Models\Banner;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\StoreInfo;
use App\Models\Alert\Alert;
use App\Models\Document\DocumentTarget;
class DocumentAdminController extends Controller
{
    /**
     * Instantiate a new DocumentAdminController instance.
     */
    public function __construct()
    {
        $this->middleware('admin.auth');
        $this->middleware('superadmin.auth');
        $this->middleware('banner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $folder_id = $request->get('folder');
        $documents = Document::getDocuments($folder_id);
        $folder = Folder::getFolderDescription($folder_id);
        $response = [];
        $response["files"] = $documents;
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

        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();     
        $storeList = StoreInfo::getStoreListing($banner->id);
        $packageHash = sha1(time() . time());
        $folders = Folder::all();
        return view('admin.documentmanager.document-upload')
            ->with('folders', $folders)
            ->with('packageHash', $packageHash)
            ->with('banner', $banner)
            ->with('storeList', $storeList)
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

    /**
     * Show form to updata meta data for specific group of files.
     *
     * @param  Request $request
     * @return Response
     */
    public function showMetaDataForm(Request $request)
    {
        $package = $request->get('package');

        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();

        $parent = $request->get('parent');
        
        $tags = Tag::where('banner_id', $banner->id)->pluck('name', 'id');
        $documents = Document::where('upload_package_id', $package)->get();

        return view('admin.document-meta.document-add-meta-data')
                ->with('documents', $documents)
                ->with('banner', $banner)
                ->with('banners', $banners)
                ->with('folder_id', $parent)
                ->with('tags', $tags);
            
    }    

    /**
     * Updata meta data for specific files.
     *
     * @param  Request $request
     * @return Response
     */
    public function updateMetaData(Request $request)
    {
        Document::updateMetaData($request);
    }       

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Document::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $document = Document::find($id);
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        // $tags = Tag::where('banner_id', $banner->id)->lists('name', 'id');
        // $tag_ids = ContentTag::where('content_id', $id)->where('content_type', 'document')->get()->pluck('tag_id');
        // $selected_tags = Tag::findMany($tag_ids)->pluck('id')->toArray();
        $storeList = StoreInfo::getStoreListing($banner->id);
        $target_stores = DocumentTarget::getTargetStoresForDocument($id);
        $all_stores = false;
        if (count($storeList) == count($target_stores)) {
            $all_stores = true;
        }
        
        $alert_types = ["" =>'Select one'];
        $alert_types += \DB::table('alert_types')->pluck('name', 'id')->toArray();
        
        $alert_details = [];
        if( Alert::where('document_id', $id)->first()) {
            $alert_details = Alert::where('document_id', $id)->first();
        }
        \Log::info('redirecting to document edit view');
        \Log::info('documents: ');
        \Log::info($document);
        \Log::info('banner');
        \Log::info($banner);
        \Log::info($banners);
        \Log::info('storelist');
        \Log::info($storeList);
        \Log::info('all_stores');
        \Log::info($all_stores);
        \Log::info('target_stores');
        \Log::info($target_stores);
        \Log::info('alert_types');
        \Log::info($alert_types);
        \Log::info('alert_details');
        \Log::info($alert_details);
        return view('admin.document-meta.document-edit-meta-data')->with('document', $document)
                                                    ->with('banner', $banner)
                                                    ->with('banners', $banners)
                                                    ->with('storeList', $storeList)
                                                    ->with('target_stores', $target_stores)
                                                    ->with('all_stores', $all_stores)
                                                    ->with('alert_types', $alert_types )
                                                    ->with('alert_details', $alert_details);
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
        return Document::updateDocument($request, $id);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $deleteDocument = Document::deleteDocument($id);
        return $deleteDocument ;
    }
}
