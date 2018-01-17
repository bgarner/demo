<?php

namespace App\Http\Controllers\Analytics;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Analytics\AnalyticsTask;
use App\Models\Analytics\AnalyticsCollection;

class AnalyticsAdminController extends Controller
{
    public function index(Request $request)
    {
    	return AnalyticsTask::getVideoReportInTimespan($request);
    }
    public function getVideoAnalyticsByPage(Request $request)
    {
    	return AnalyticsCollection::getPaginatedVideoStats($request);

    }
}
