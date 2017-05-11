<?php

namespace App\Http\Controllers\Calendar;

// use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Event\Event;
use App\Models\Event\EventType;
use App\Models\Tag\ContentTag;
use App\Models\Tag\Tag;
use App\Models\Banner;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;
use App\Models\StoreInfo;
use App\Models\Event\EventTarget;
use App\Models\Document\FolderStructure;
use App\Models\Event\EventAttachment;

class CalendarAdminController extends Controller
{
    /**
     * Instantiate a new CalendarAdminController instance.
     */
    public function __construct()
    {
        //
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::getEventsByBannerId();
        return view('admin.calendar.index')
            ->with('events', $events);            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $banner = UserSelectedBanner::getBanner();

        $event_types_list = EventType::getEventTypeListByBannerId($banner->id);
        $storeList = StoreInfo::getStoreListing($banner->id);
        $folderStructure = FolderStructure::getNavigationStructure($banner->id);

        return view('admin.calendar.create')
            ->with('event_types_list', $event_types_list)
            ->with('stores', $storeList)
            ->with('folderStructure', $folderStructure);     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Event::storeEvent($request);   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.calendar.show');
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

        $event = Event::find($id);
        
        $event_type = EventType::find($id);
        $event_types_list = EventType::getEventTypeListByBannerId($banner->id);
        
        
        $event_target_stores = EventTarget::where('event_id', $id)->get()->pluck('store_id')->toArray();
        $storeList = StoreInfo::getStoreListing($banner->id);
        $event_attachments = EventAttachment::getEventAttachments($id);
        $folderStructure = FolderStructure::getNavigationStructure($banner->id);
        return view('admin.calendar.edit')
            ->with('event', $event)
            ->with('event_type', $event_type)
            ->with('event_types_list', $event_types_list)
            ->with('storeList', $storeList)
            ->with('target_stores', $event_target_stores)
            ->with('event_attachments', $event_attachments)
            ->with('folderStructure', $folderStructure);     
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

        $response = Event::updateEvent($id, $request);
        \Log::info($response);
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        $event = Event::find($id);
        $event->delete();
    }
}
