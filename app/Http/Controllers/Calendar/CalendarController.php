<?php

namespace App\Http\Controllers\Calendar;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 
use DB;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Event\Event;
use App\Models\Event\EventType;
use App\Models\Utility\Utility;
use App\Models\Event\EventAttachment;
use App\Models\ProductLaunch\ProductLaunch;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $today = date("Y") . "-" . date("m");
        $today = (string) $today; 

        $storeNumber = RequestFacade::segment(1);

        //for the calendar view
        $events = Event::getActiveEventsAndProductLaunchForCalendarViewByStore($storeNumber);

        //for the list of events
        $eventsList = Event::getListofEventsByStoreAndMonth($storeNumber, $today);
        
        return view('site.calendar.index')
                ->with('events', $events)
                ->with('eventsList', $eventsList)
                ->with('today', $today);
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

    public function getEventListPartial($storeNumber, $yearMonth)
    {
        $eventsList = Event::getListofEventsByStoreAndMonth($storeNumber, $yearMonth);
        return view('site.calendar.event-list-partial')->with('eventsList', $eventsList);

    }

   

}
