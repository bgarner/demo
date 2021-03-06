<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\StoreApi\StoreInfo;
use App\Skin;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Utility\Utility;
use App\Models\Search\Search;
use App\Models\Communication\Communication;
use App\Models\Alert\Alert;
use App\Models\StoreApi\Banner;

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
            $videos = Search::searchVideos($query, $store);

            if( isset($request['archives']) && $request['archives'])
            {
                $docs = $docs->merge(Search::searchArchivedDocuments($query, $store));
                $communications = $communications->merge(Search::searchArchivedCommunications($query, $store));
                $alerts = $alerts->merge(Search::searchArchivedAlerts($query, $store));
                $events = $events->merge(Search::searchArchivedEvents($query, $store));
            }
        }

        return view('site.search.index')
            ->with('docs', $docs)
            ->with('folders', $folders)
            ->with('communications', $communications)
            ->with('alerts', $alerts)
            ->with('events', $events)
            ->with('videos', $videos)
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
