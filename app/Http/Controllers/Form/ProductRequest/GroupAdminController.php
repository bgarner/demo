<?php

namespace App\Http\Controllers\Form\ProductRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\FormGroupMap;
use App\Models\Form\FormGroup;
use App\Models\Auth\User\User;
use App\Models\Utility\Utility;
use App\Models\Form\Form;
use App\Models\Form\ProductRequest\BusinessUnitTypes;
use App\Models\Form\ProductRequest\FormGroupBusinessUnitMap;


class GroupAdminController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
		$groups =  FormGroupMap::getUserGroupsByFormAndRoleId();
        return view('formuser.groups.index')->with('groups', $groups);
                        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $formusers  = [];
        $forms = Form::getFormListByRoleId();
        $businessUnits = BusinessUnitTypes::getBUList();
        return view('formuser.groups.create')->with('formusers', $formusers)
        									->with('forms', $forms)
                                            ->with('businessUnits', $businessUnits);
                                            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return FormGroup::createGroup($request);
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
        $group = FormGroup::getGroupDetailsByFormGroupId($id);
        $businessUnits = BusinessUnitTypes::getBUList();
        $selectedBU = FormGroupBusinessUnitMap::getBusinessUnitByGroup($id);
        return view('formuser.groups.edit')
                ->with('group', $group)
                ->with('businessUnits', $businessUnits)
                ->with('selectedBU', $selectedBU);
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
        return FormGroup::editGroup($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FormGroup::deleteGroup($id);
    }
}
