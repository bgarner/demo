<?php

namespace App\Http\Controllers\Calendar;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Event\Event;
use App\Models\Event\EventType;

use App\Models\Banner;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;

class EventTypesAdminController extends Controller
{
    /**
     * Instantiate a new EventTypesAdminController instance.
     */
    public function __construct()
    {
        $this->middleware('admin.auth');
        $this->middleware('superadmin.auth');
        $this->middleware('banner');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = \Auth::user()->id;
        $banner_ids = UserBanner::where('user_id', $user_id)->get()->pluck('banner_id');
        $banners = Banner::whereIn('id', $banner_ids)->get();        
        $banner_id = UserSelectedBanner::where('user_id', \Auth::user()->id)->first()->selected_banner_id;
        $banner  = Banner::find($banner_id);

        // $eventtypes = EventType::all();
        $eventtypes = EventType::where('banner_id', $banner_id)->get();

        return view('admin.eventtypes.index')
            ->with('eventtypes', $eventtypes)
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
        $user_id = \Auth::user()->id;
        $banner_ids = UserBanner::where('user_id', $user_id)->get()->pluck('banner_id');
        $banners = Banner::whereIn('id', $banner_ids)->get();        
        $banner_id = UserSelectedBanner::where('user_id', \Auth::user()->id)->first()->selected_banner_id;
        $banner  = Banner::find($banner_id);

        $event_types_list = EventType::all();
        return view('admin.eventtypes.create')
            ->with('event_types_list', $event_types_list)
            ->with('banner', $banner)
            ->with('banners', $banners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = EventType::validateEventType($request);
        
        if($validate['validation_result'] == 'false') {
          \Log::info($validate);
          return json_encode($validate);
        }

        $eventTypeDetails = array(
            'event_type' => $request['event_type'],
            'banner_id' => $request['banner_id']
        );

        $eventType = EventType::create($eventTypeDetails);
        $eventType->save();
        return $eventType;
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
        $user_id = \Auth::user()->id;
        $banner_ids = UserBanner::where('user_id', $user_id)->get()->pluck('banner_id');
        $banners = Banner::whereIn('id', $banner_ids)->get();        
        $banner_id = UserSelectedBanner::where('user_id', \Auth::user()->id)->first()->selected_banner_id;
        $banner  = Banner::find($banner_id);

        $eventType = EventType::find($id);

        return view('admin.eventtypes.edit')
            ->with('eventType', $eventType)
            ->with('banner', $banner)
            ->with('banners', $banners);
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

        $validate = EventType::validateEventType($request);
        
        if($validate['validation_result'] == 'false') {
          \Log::info($validate);
          return json_encode($validate);
        }

        $eventType =  EventType::find($id);

        $eventType->event_type = $request['event_type'];
    
        $eventType->save();

        return $eventType;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $id = Request::input('event_id');
        // $id = $request['event_id'];
        $eventtype = EventType::find($id);
        $eventtype->delete();
    }
}
