<?php

namespace App\Http\Controllers\Calendar;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade;
use DB;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Store;
use App\Models\Event\Event;
use App\Models\Event\EventTypeBanner;
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

        //event types
        //get the current banner
        $banner = Store::where('store_number', $storeNumber)->get(['banner_id'])->first();

        //get all of the event types that belong to this banner
        $eventTypesforBanner = EventTypeBanner::where('banner_id', $banner['banner_id'])->select('event_type_id')->get()->pluck('event_type_id');   
        $eventTypes = EventType::whereIn('id', $eventTypesforBanner)->get();

        return view('site.calendar.index')
                ->with('events', $events)
                ->with('eventsList', $eventsList)
                ->with('eventTypes', $eventTypes)
                ->with('today', $today);
    }


    public function getEventListPartial($storeNumber, $yearMonth)
    {
        $eventsList = Event::getListofEventsByStoreAndMonth($storeNumber, $yearMonth);
        return view('site.calendar.event-list-partial')->with('eventsList', $eventsList);

    }



}
