<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Document\Document;
use App\Models\Document\FolderStructure;
use App\Models\Document\FileFolder;
use App\Models\Document\Package;
use App\Models\Banner;
use App\Models\Document\DocumentPackage;
use App\Models\Tag\Tag;
use App\Models\Tag\ContentTag;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Document\Folder;
use App\Models\Document\FolderPackage;
use App\Models\Feature\FeaturePackage;
use App\Models\Auth\User\UserBanner;

class PackageAdminController extends Controller
{
    /**
     * Instantiate a new packageAdminController instance.
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = \Auth::user()->id;
        $banner_ids = UserBanner::where('user_id', $user_id)->get()->pluck('banner_id');
        $banners = Banner::whereIn('id', $banner_ids)->get();        
        $banner_id = UserSelectedBanner::where('user_id', \Auth::user()->id)->first()->selected_banner_id;
        $banner  = Banner::find($banner_id);

        $packages = Package::where('banner_id', $banner->id)->get();
        return view('admin/package/index')
                ->with('banner', $banner)
                ->with('banners',$banners)
                ->with('packages',$packages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();

        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $folderStructure = FolderStructure::getNavigationStructure($banner->id);

        $tags = Tag::where('banner_id', $banner->id)->pluck('name', 'id');
            
        return view('admin.package.create')
                    ->with('banner', $banner)
                    ->with('banners',$banners)
                    ->with('navigation', $fileFolderStructure)
                    ->with('folderStructure', $folderStructure)
                    ->with('tags', $tags);
                    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        return Package::storePackage($request);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = [];
        $response["package"] = Package::find($id);
        $response["documentDetails"] = Package::getPackageDocumentDetails($id);
        $packageFolders = FolderPackage::where('package_id', $id)->get()->pluck('folder_id');
        
        $counter = 0;
        foreach ($packageFolders as $folder) {
            $response["folderDetails"][$counter] = Folder::getFolderChildrenTree($folder);
            $counter++;
        } 
        
        return ($response);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $package = Package::find($id);
        $documentDetails = Package::getPackageDocumentDetails($id);
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all(); 

        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $tags = Tag::where('banner_id', $banner->id)->pluck('name', 'id');

        $tag_ids = ContentTag::where('content_id', $id)->where('content_type', 'package')->get()->pluck('tag_id');
        $selected_tags = Tag::findMany($tag_ids)->pluck('id')->toArray();

        $folderStructure = FolderStructure::getNavigationStructure($banner->id);
        
        $selected_folder_ids = FolderPackage::where('package_id', $id)->get()->pluck('folder_id');
        $selected_folders = array();
        foreach ($selected_folder_ids as $folder_id) {
            $folder_details =  \DB::table('folder_ids')->where('id' , $folder_id)->first();

            if ($folder_details->folder_type == 'folder') {
                $folder_desc = Folder::where('id', $folder_details->folder_id)->first();
                $folder_desc->folder_path = Folder::getFolderPath($folder_id);
                $folder_desc->global_folder_id = $folder_details->id;
                array_push($selected_folders, $folder_desc );
            }
        }
        return view('admin.package.edit')->with('package', $package)
                                        ->with('documentDetails', $documentDetails)
                                        ->with('banner', $banner)
                                        ->with('banners', $banners)
                                        ->with('navigation', $fileFolderStructure)
                                        ->with('tags', $tags)
                                        ->with('selected_tags', $selected_tags)
                                        ->with('folders', $selected_folders)
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
        return Package::updatePackage($request, $id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DocumentPackage::where('package_id', $id)->delete();
        FolderPackage::where('package_id', $id)->delete();
        FeaturePackage::where('package_id', $id)->delete();
        Package::find($id)->delete();
        return;
    }
}
