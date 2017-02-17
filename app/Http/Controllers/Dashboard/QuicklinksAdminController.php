<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Quicklinks;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Banner;
use App\Models\Document\Folder;
use App\Models\Document\FileFolder;
use App\Models\Document\FolderStructure;
use App\Models\Document\FolderPackage;
use App\Models\Auth\User\UserBanner;
use App\Models\Dashboard\QuicklinkTypes;

class QuicklinksAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $fileFolderStructure = FileFolder::getFileFolderStructure($banner->id);
        $folderStructure = FolderStructure::getNavigationStructure($banner->id);

        $quicklink_types = QuicklinkTypes::all();
        
        return view('admin.quicklinks.create')
                    ->with('banner', $banner)
                    ->with('banners',$banners)
                    ->with('navigation', $fileFolderStructure)
                    ->with('folderStructure', $folderStructure)
                    ->with('quicklink_types', $quicklink_types);

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Quicklinks::storeQuicklink($request);
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
        $quicklink = Quicklinks::find($id);
        $quicklink->order = $request['order'];
        $quicklink->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quicklink = Quicklinks::find($id);
        $quicklink->delete();
    }
}
