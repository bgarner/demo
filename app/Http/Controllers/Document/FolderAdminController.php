<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Document\Folder;
use App\Models\Document\FolderStructure;
use App\Models\Document\Week;
use App\Models\Document\FileFolder;
use App\Models\Document\Document;
use App\Models\StoreApi\Banner;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\Auth\User\UserSelectedBanner;

class FolderAdminController extends Controller
{
    
    /**
     * Instantiate a new FolderAdminController instance.
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
        $banner = UserSelectedBanner::getBanner();

        $navigation = FolderStructure::getNavigationStructure($banner->id);
        return view('admin.folderstructure.index')->with('navigation', $navigation)
                                                     ->with('banner', $banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        
        $banner = UserSelectedBanner::getBanner();
        $parent = null;
        if (isset($request['parent'])) {
            $parent = $request['parent'];
        }       
        return view('admin.documentmanager.folder-add-modal')->with('banner', $banner)
                                         ->with('parent', $parent);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $result = Folder::storeFolder($request);

        $result = json_decode($result);
        if(isset($result->validation_result) && $result->validation_result == 'false')
        {
            return redirect('/admin/document/manager#!/'.$request['parent'])->with('errors', $result->errors->name);
        }
        return redirect('/admin/document/manager#!/'.$request['parent']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $folder_id = \DB::table('folder_ids')->where('id', $id)->first()->folder_id;
        
        $folder = Folder::find($folder_id);

        $params =  Folder::getFolderDetails($id);
        
        $banner = UserSelectedBanner::getBanner();

        return view('admin.documentmanager.folder-edit-modal')->with('folder', $folder)
                                        ->with('params', $params)
                                        ->with('banner', $banner);
        
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
        
        $name = $request->get('name');
        $children = $request->get('child');
        $weekWindowSize = $request->get('weekWindowSize');
        $removeWeeks = $request->get('removeWeeks');
        
        $global_folder_id = \DB::table('folder_ids')->where('folder_id', $id)->where('folder_type', 'folder')->first()->id;
        Folder::updateTags($global_folder_id, $request["tags"]);
        $banner_id = Folder::editFolderDetails(compact('id', 'name', 'children', 'weekWindowSize', 'removeWeeks'));

        return redirect('/admin/document/manager#!/'.$global_folder_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        Folder::deleteFolder($id, $request);
        return;
    }
}
