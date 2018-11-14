<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Banner;
use App\Models\Document\FolderStructure;
use App\Models\Document\Folder;
use App\Models\Document\Package;
use App\Models\Communication\Communication;
use App\User;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\Analytics\AnalyticsCollection;
use Carbon\Carbon;
use App\Models\Utility\Utility;

class AdminController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $commStats = AnalyticsCollection::getActiveCommunicationStats();
        $urgentNoticeStats = AnalyticsCollection::getActiveUrgentNoticeStats();
        $taskStats = AnalyticsCollection::getTaskStats();
        
        $paginatedVideos = AnalyticsCollection::getPaginatedVideoStats($request);        
        $videoStats = $paginatedVideos['videoStats'];
        $videoNextPageIndex = $paginatedVideos['nextPage'];
        $videoPreviousPageIndex = $paginatedVideos['previousPage'];
        
        $today = Carbon::now();
        $lastCompiledTimestamp = AnalyticsCollection::orderBy('created_at', 'desc')->first()->created_at;
        $prettyLastCompiledTimestamp = Utility::prettifyDateWithTime($lastCompiledTimestamp);

        $banners = Banner::getAllBanners();
        return view('admin.index')
                    ->with('commStats', $commStats)
                    ->with('urgentNoticeStats', $urgentNoticeStats)
                    ->with('taskStats', $taskStats)
                    ->with('videoStats', $videoStats)
                    ->with('today', $today)
                    ->with('prettyLastCompiledTimestamp', $prettyLastCompiledTimestamp)
                    ->with('videoNextPageIndex', $videoNextPageIndex)
                    ->with('videoPreviousPageIndex', $videoPreviousPageIndex)
                    ->with('banners', $banners);
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
