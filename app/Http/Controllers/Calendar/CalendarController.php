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
use App\Skin;
use App\Models\StoreInfo;
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

        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);

        $storeBanner = $storeInfo->banner_id;

        $skin = Skin::getSkin($storeBanner);

        //for the calendar view
        $events = Event::getActiveEventsByStore($storeNumber);
        $productLaunches = ProductLaunch::getActiveProductLaunchByStoreForCalendar($storeNumber);
        $events = $events->merge($productLaunches); 
        
        //for the list of events
        $eventsList = $this->getListofEventsByStoreAndMonth($storeNumber, $today);
        
        foreach ($events as $event) {
            $event->prettyDateStart = Utility::prettifyDate($event->start);
            $event->prettyDateEnd = Utility::prettifyDate($event->end);
            $event->since = Utility::getTimePastSinceDate($event->start);
            $attachments = EventAttachment::getEventAttachments($event->id);
            $attachment_link_string = "";
            foreach ($attachments as $a) {

                $attachment_link_string .= "<a href='/".$storeNumber."/document#!/".$a->id."'>". $a->name ."</a><br>";
                
            }
            
            $event->attachment = $attachment_link_string;
            if(!isset($event->event_type_name)){
                $event->event_type_name = EventType::getName($event->event_type);
            }
        }
        
        return view('site.calendar.index')
                ->with('skin', $skin)
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
        $eventsList = $this->getListofEventsByStoreAndMonth($storeNumber, $yearMonth);
        return view('site.calendar.event-list-partial')->with('eventsList', $eventsList);

    }

    public function getListofEventsByStoreAndMonth($storeNumber, $yearMonth)
    {
        $eventsList = Event::getActiveEventsByStoreAndMonth($storeNumber, $yearMonth);
        $productLaunchList = ProductLaunch::getActiveProductLaunchByStoreandMonth($storeNumber, $yearMonth);
        
        foreach ($productLaunchList as $key => $value) {
            
            if(array_key_exists($key, $eventsList)){

                $value = $value->merge($eventsList[$key]);
            }
            else{
                $eventsList->put($key, $value);
            }
            
        }
        $eventsList = $eventsList->toArray();
        ksort($eventsList);
        $eventsList = json_decode(json_encode($eventsList));

        return $eventsList;
    }

}
