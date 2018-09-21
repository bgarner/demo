<?php

namespace App\Http\Controllers\Form\ProductRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\ProductRequest\Analytics;
use App\Models\Form\ProductRequest\FormUserBusinessUnitMap;
use App\Models\Form\ProductRequest\FormGroupBusinessUnitMap;
use App\Models\Form\FormStatusMap;
use App\Models\Form\FormHighlighting;
use App\Models\Form\FormRoleHierarchy;
use App\Models\Auth\User\User;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $forms = Analytics::getFormsForDashboard();
        $analytics = Analytics::getAnalyticsForFormUser();

        $role = preg_replace("/\s+/", "", \Auth::user()->role);

        $accessibleRoles = FormRoleHierarchy::getAllAccessibleRoles();

        $businessUnitId = FormUserBusinessUnitMap::getBusinessUnitIdsByFormUserId(\Auth::user()->id);

        $users = User::getUsersByBusinessUnitAndRoles($accessibleRoles, $businessUnitId);

        $groups = FormGroupBusinessUnitMap::getGroupsByCurrentBusinessUnitId();
        
        $highlights = FormHighlighting::all()->pluck('store_number');

        $codes = FormStatusMap::getStatusCodesByForm(1);
        
        return view('formuser.'.$role.'.dashboard.index')->with('forms', $forms)
                                        ->with('analytics', $analytics)
                                        ->with('users', $users)
                                        ->with('groups', $groups)
                                        ->with('codes', $codes)
                                        ->with('highlights', $highlights->toArray());
    }
}
