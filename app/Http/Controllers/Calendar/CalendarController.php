<?php

namespace App\Http\Controllers\Calendar;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacade; 
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Event\Event;
use App\Models\Event\EventTypes;
use App\Models\Banner;

use App\Models\Communication\Communication;
use App\Models\Communication\CommunicationDocument;
use App\Models\Communication\CommunicationPackage;
use App\Models\Communication\CommunicationTarget;
use App\Models\UrgentNotice\UrgentNotice;
use App\Models\Alert\Alert;
use App\Skin;
use App\Models\StoreInfo;
use App\Models\Utility\Utility;
use App\Models\Event\EventAttachment;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $storeNumber = RequestFacade::segment(1);

        $storeInfo = StoreInfo::getStoreInfoByStoreId($storeNumber);

        $storeBanner = $storeInfo->banner_id;

        $skin = Skin::getSkin($storeBanner);


        $communicationCount = Communication::getActiveCommunicationCount($storeNumber);

        $urgentNoticeCount = UrgentNotice::getUrgentNoticeCount($storeNumber);

        $alertCount = Alert::getActiveAlertCountByStore($storeNumber);

        $events = Event::getActiveEventsByStore($storeNumber); 

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
        }
        
        return view('site.calendar.index')
                ->with('skin', $skin)
                ->with('alertCount', $alertCount)
                ->with('communicationCount', $communicationCount)
                ->with('events', $events)
                ->with('urgentNoticeCount', $urgentNoticeCount);

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
