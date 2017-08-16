<?php

namespace App\Http\Controllers\Document;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Banner;
use App\Models\Document\FolderStructure;
use App\Models\Document\Folder;
use App\Models\Document\Package;
use App\Models\Communication\Communication;
use App\Models\Auth\User\User;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;

class DocumentManagerController extends Controller
{

    private $group_id;
    private $user_id;
     /**
     * Instantiate a new DocumentManagerController instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->user_id = \Auth::user()->id;
        
        $this->group_id = \Auth::user()->group_id;

        $banner_id = UserSelectedBanner::where('user_id', \Auth::user()->id)->first()->selected_banner_id;

        $banner  = Banner::find($banner_id);

        $navigation = FolderStructure::getNavigationStructure($banner->id);

        $packages = Package::getAllPackages($banner->id);

        $packageHash = sha1(time() . time());

        $folders = Folder::all();

        $defaultFolder = $request->get('parent');

        if (!isset($defaultFolder)) {
            $defaultFolder = null;
        }


            $banner_ids = UserBanner::where('user_id', $this->user_id)->get()->pluck('banner_id');
            $banners = Banner::whereIn('id', $banner_ids)->get();
            
            //return view('admin.document-view')
            return view('admin.documentmanager.index')
                ->with('navigation', $navigation)
                ->with('folders', $folders)
                ->with('packageHash', $packageHash)
                ->with('banner', $banner)
                ->with('banners', $banners)
                ->with('packages', $packages)
                ->with('defaultFolder' , $defaultFolder);

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
