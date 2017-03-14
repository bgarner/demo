<?php

namespace App\Http\Controllers\Feature;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Banner;
use App\Models\UserSelectedBanner;
use App\Models\Feature\Feature;
use App\Models\Document\FileFolder;
use App\Models\Document\Package;
use App\Models\Document\Document;
use App\Models\Feature\FeatureDocument;
use App\Models\Feature\FeaturePackage;

class FeatureAdminController extends Controller
{

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
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        $features = Feature::where('banner_id', $banner->id)->get();
                
        return view('admin.feature.index')
                ->with('features', $features)
                ->with('banner', $banner)
                ->with('banners', $banners);
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

        $packages = Package::where('banner_id', $banner->id)->get();
        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        return view('admin.feature.create')
                ->with('banner', $banner)
                ->with('banners', $banners)
                ->with('navigation', $fileFolderStructure)
                ->with('packages', $packages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Feature::storeFeature($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $feature = Feature::find($id);

        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $feature_documents = FeatureDocument::where('feature_id', $id)->get()->pluck('document_id');
        $selected_documents = array();
        foreach ($feature_documents as $doc_id) {
            
            $doc = Document::find($doc_id);
            $doc->folder_path = Document::getFolderPathForDocument($doc_id);
            array_push($selected_documents, $doc );
            
        }

        $packages = Package::where('banner_id', $banner->id)->get();
        $feature_packages = FeaturePackage::where('feature_id', $id)->get()->pluck('package_id');
        $selected_packages = [];
        foreach ($feature_packages as $package_id) {
            $package = Package::find($package_id);
            array_push($selected_packages, $package);
        }

        return view('admin.feature.edit')->with('feature', $feature)
                                    
                                        ->with('banner', $banner)
                                        ->with('banners', $banners)
                                        ->with('navigation', $fileFolderStructure)
                                        ->with('feature_documents', $selected_documents )
                                        ->with('packages', $packages)
                                        ->with('feature_packages', $selected_packages);
                                        // ->with('tags', $tags)
                                        // ->with('selected_tags', $selected_tags)
                                        // ->with('folders', $selected_folders)
                                        // ->with('folderStructure', $folderStructure);
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
        return Feature::updateFeature($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Feature::deleteFeature($id);
        return;
    }

    public function getFeatureDocumentPartial($feature_id)
    {
        $documents = Feature::getTopListedDocumentsByFeatureId($feature_id);
        return view('admin.feature.feature-documents-partial')->with('documents', $documents);
    }

    public function getFeaturePackagePartial($feature_id)
    {
        $packages = Feature::getPackageDetailsByFeatureId($feature_id);

        return view('admin.feature.feature-packages-partial')->with('packages', $packages);
    }
}
