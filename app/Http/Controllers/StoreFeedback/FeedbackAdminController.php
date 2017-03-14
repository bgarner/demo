<?php

namespace App\Http\Controllers\StoreFeedback;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Banner;
use App\Http\Controllers\Controller;
use App\Models\UserSelectedBanner;
use App\Models\BugReport\BugReport;
use App\Models\StoreFeedback\FeedbackCategoryTypes;
use App\Models\StoreFeedback\FeedbackStatusTypes;
use App\Models\StoreFeedback\FeedbackResponse;

class FeedbackAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        $feedbacks = BugReport::getAllBugReports($banner->id);

        return view('admin.storefeedback.index')->with('feedbacks', $feedbacks)
                                                ->with('banner', $banner)
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
        $banner = UserSelectedBanner::getBanner();
        $banners = Banner::all();
        $feedback = BugReport::getBugReportById($id);
        $feedback_category_list = FeedbackCategoryTypes::getFeedbackCategoryList();
        $feedback_status_list = FeedbackStatusTypes::getFeedbackStatusList();
        
        return view('admin.storefeedback.edit')->with('feedback', $feedback)
                                                ->with('banner', $banner)
                                                ->with('banners', $banners)
                                                ->with('feedback_category_list', $feedback_category_list)
                                                ->with('feedback_status_list', $feedback_status_list);     
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
        FeedbackResponse::updateFeedbackResponse($id, $request);
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
