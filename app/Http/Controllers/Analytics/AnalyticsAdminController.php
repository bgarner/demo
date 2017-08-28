<?php

namespace App\Http\Controllers\Analytics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Analytics\AnalyticsTask;

class AnalyticsAdminController extends Controller
{
    public function index(Request $request)
    {
    	return AnalyticsTask::getVideoReportInTimespan($request);
    }
}
