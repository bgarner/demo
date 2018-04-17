<?php

namespace App\Http\Controllers\Form\ProductRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Form\ProductRequest\Analytics;

class DashboardAdminController extends Controller
{
    public function index()
    {
    	$forms = Analytics::getFormsForFormUser();
    	$analytics = Analytics::getAnalyticsForFormUser();

    	//change view to formuser.{role}.dashboard
    	return view('formuser.dashboard.index')->with('forms', $forms)
    									->with('analytics', $analytics);
    }
}
