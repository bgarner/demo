<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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

class DocumentAdminController extends Controller
{
    /**
     * Instantiate a new DocumentAdminController instance.
     */
    public function __construct()
    {
       //
    }

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
        $storeList   = StoreInfo::getStoreListing($banner->id);
        // $storeAndStoreGroups = Utility::getStoreAndStoreGroupList($banner->id);

        $packageHash = sha1(time() . time());
        $folders     = Folder::all();
        return view('admin.documentmanager.document-upload')
            ->with('folders', $folders)
            ->with('packageHash', $packageHash)
            ->with('banner', $banner)
            ->with('storeList', $storeList);
            // ->with('storeAndStoreGroups', $storeAndStoreGroups);
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
        $package     = $request->get('package');

        $banner      = UserSelectedBanner::getBanner();

        $parent      = $request->get('parent');

        $alert_types = ["" =>'Select one'];

        $alert_types = \DB::table('alert_types')->pluck('name', 'id')->toArray();

        $documents   = Document::where('upload_package_id', $package)->get();

        $documentContext["folder"] = Folder::getFolderDescription($parent);

        return view('admin.document-meta.document-add-meta-data')
                ->with('documents', $documents)
                ->with('banner', $banner)
                ->with('folder_id', $parent)
                ->with('alert_types', $alert_types )
                ->with('documentContext', json_encode($documentContext));
            
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
        $document            = Document::find($id);
        $banner              = UserSelectedBanner::getBanner();
        $target_stores       = DocumentTarget::getTargetStoresForDocument($id);
        
        $alert_types         = ["" => 'Select one'];
        $alert_types        += \DB::table('alert_types')->pluck('name', 'id')->toArray();
        
        $alert_details       = [];
        if( Alert::where('document_id', $id)->first()) {
        $alert_details       = Alert::where('document_id', $id)->first();
        }

        $folderStructure     = FolderStructure::getNavigationStructure($banner->id);
        $folderPath          = Document::getFolderPathForDocument($id);

        $storeList           = StoreInfo::getStoreListing($banner->id);
        // $storeAndStoreGroups = Utility::getStoreAndStoreGroupList($banner->id);

        $tags = Tag::all()->pluck('name', 'id');
        $selected_tags = ContentTag::getTagsByContentId('document', $id);

        return view('admin.document-meta.document-edit-meta-data')->with('document', $document)
                                                    ->with('banner', $banner)
                                                    ->with('target_stores', $target_stores)
                                                    ->with('alert_types', $alert_types ) 
                                                    ->with('alert_details', $alert_details)
                                                    ->with('folderStructure', $folderStructure)
                                                    ->with('folderPath', $folderPath)
                                                    ->with('storeList', $storeList)
                                                    ->with('tags', $tags)
                                                    ->with('selectedTags', $selected_tags);
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
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function replaceDocument(Request $request, $id)
    {
        return Document::replaceDocument($request, $id);
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
