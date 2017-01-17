<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Auth\Group;
use App\Models\UserSelectedBanner;
use App\Models\Banner;
use App\Models\Auth\Section;
use App\Models\Auth\GroupSection;

class GroupAdminController extends Controller
{
    public $banner;
    public $banners;

    public function __construct()
    {
        $this->banner = UserSelectedBanner::getBanner();
        $this->banners = Banner::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups =  Group::all();
        return view('admin.groups.index')->with('groups', $groups)
                        ->with('banners', $this->banners)
                        ->with('banner', $this->banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::getSectionList($this->banner->id);
        // dd($sections);
        return view('admin.groups.create')->with('banner', $this->banner)
                                            ->with('banners', $this->banners)
                                            ->with('sections', $sections);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = Group::createGroup($request);
        return  $group;
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
        $group = Group::find($id);
        $sections = Section::getSectionList($this->banner->id);
        $selected_sections = GroupSection::getSectionListByGroupId($id);
        return view('admin.groups.edit')->with('banners', $this->banners)
                                        ->with('banner', $this->banner)
                                        ->with('sections', $sections)
                                        ->with('group', $group)
                                        ->with('selected_sections', $selected_sections);
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
        return Group::editGroup($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Group::deleteGroup($id);
    }
}
