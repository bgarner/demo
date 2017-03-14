<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\StoreInfo;
use App\Skin;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Utility\Utility;
use App\Models\Search\Search;
use App\Models\Communication\Communication;
use App\Models\Alert\Alert;
use App\Models\Banner;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = $request['q'];
        $store = RequestFacade::segment(1);

        $alertCount = Alert::getActiveAlertCountByStore($store);
        $communicationCount = Communication::getActiveCommunicationCount($store);

        $docs = [];
        $folders = [];
        $communications = [];
        $alerts = [];
        $events = [];
        $videos = [];

        $query = ltrim(rtrim($query));
        if ( isset($query) && ($query != '')){
            $docs = Search::searchDocuments($query, $store);
            $folders = Search::searchFolders($query);
            $communications = Search::searchCommunications($query, $store);
            $alerts = Search::searchAlerts($query, $store);
            $events = Search::searchEvents($query, $store);
            $videos = Search::searchVideos($query);

            if( isset($request['archives']) && $request['archives'])
            {
                $docs = $docs->merge(Search::searchArchivedDocuments($query, $store));
                $communications = $communications->merge(Search::searchArchivedCommunications($query, $store));
                $alerts = $alerts->merge(Search::searchArchivedAlerts($query, $store));
                $events = $events->merge(Search::searchArchivedEvents($query, $store));
            }
        }

        $storeNumber = RequestFacade::segment(1);

        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);

        $storeBanner = $storeInfo->banner_id;

        $banner = Banner::find($storeBanner);

        $isComboStore = $storeInfo->is_combo_store;

        $skin = Skin::getSkin($storeBanner);

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);

        return view('site.search.index')
            ->with('skin', $skin)
            ->with('urgentNoticeCount', $urgentNoticeCount)
            ->with('docs', $docs)
            ->with('folders', $folders)
            ->with('communications', $communications)
            ->with('alerts', $alerts)
            ->with('events', $events)
            ->with('videos', $videos)
            ->with('communicationCount', $communicationCount)
            ->with('isComboStore', $isComboStore)
            ->with('banner', $banner)
            ->with('alertCount', $alertCount)
            ->with('query', $query)
            ->with('archives', $request['archives']);
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
