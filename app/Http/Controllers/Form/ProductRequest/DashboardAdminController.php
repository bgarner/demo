<?php

namespace App\Http\Controllers\Form\ProductRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\ProductRequest\Analytics;
use App\Models\Form\ProductRequest\FormUserBusinessUnitMap;
use App\Models\Form\ProductRequest\FormGroupBusinessUnitMap;

class DashboardAdminController extends Controller
{
    public function index()
    {
    	$forms = Analytics::getFormsForFormUser();
    	$analytics = Analytics::getAnalyticsForFormUser();
    	$role = preg_replace("/\s+/", "", \Auth::user()->role);

        $users = FormUserBusinessUnitMap::getUsersByCurrentBusinessUnitId();

        $groups = FormGroupBusinessUnitMap::getGroupsByCurrentBusinessUnitId();
        
    	return view('formuser.'.$role.'.dashboard.index')->with('forms', $forms)
    									->with('analytics', $analytics)
                                        ->with('users', $users)
                                        ->with('groups', $groups);
    }
}
