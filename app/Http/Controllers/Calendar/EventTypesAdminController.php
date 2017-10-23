<?php

namespace App\Http\Controllers\Calendar;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Event\Event;
use App\Models\Event\EventType;

use App\Models\StoreApi\Banner;
use App\Models\Auth\User\UserBanner;
use App\Models\Auth\User\UserSelectedBanner;

class EventTypesAdminController extends Controller
{
    /**
     * Instantiate a new EventTypesAdminController instance.
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
        $banner = UserSelectedBanner::getBanner();
        $eventtypes = EventType::getEventTypesForAdmin();

        return view('admin.eventtypes.index')
            ->with('eventtypes', $eventtypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banners = UserBanner::getAllBanners()->pluck('name', 'id')->toArray();
        return view('admin.eventtypes.create')->with('banners', $banners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return EventType::createEventType($request);
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
        $banners = UserBanner::getAllBanners()->pluck('name', 'id')->toArray();
        $eventType = EventType::getEventTypeById($id);
        return view('admin.eventtypes.edit')->with('eventType', $eventType)
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
        return EventType::updateEventType($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EventType::find($id)->delete();
    }
}
