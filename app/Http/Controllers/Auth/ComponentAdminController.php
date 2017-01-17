<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserSelectedBanner;
use App\Models\Banner;
use App\Models\Auth\Group;
use App\Models\Auth\Component;
use App\Models\Auth\GroupComponent;

class ComponentAdminController extends Controller
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
        $components =  Component::getComponentDetails();
        return view('admin.components.index')->with('components', $components)
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
        $groups = Group::getGroupList($this->banner->id);
        return view('admin.components.create')->with('banner', $this->banner)
                                            ->with('banners', $this->banners)
                                            ->with('groups', $groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $component = Component::createComponent($request);
        return  $component;
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
        $component = Component::find($id);
        $groups = Group::getGroupList($this->banner->id);
        $selected_groups = GroupComponent::getGroupListByComponentId($id);
        return view('admin.components.edit')->with('banners', $this->banners)
                                        ->with('banner', $this->banner)
                                        ->with('component', $component)
                                        ->with('groups', $groups)
                                        ->with('selected_groups', $selected_groups);
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
        return Component::editComponent($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Component::deleteComponent($id);
    }
}
