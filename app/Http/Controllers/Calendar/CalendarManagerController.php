<?php

namespace App\Http\Controllers\Calendar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\StoreInfo;
use App\Models\Tools\CustomStoreGroup;
use App\Models\Auth\User\UserBanner;
use App\Models\Event\Event;

class CalendarManagerController extends Controller
{
    protected $user_id;
    protected $stores;
    protected $storeGroups;
    protected $banners;

    public function __construct()
    {
		
		
    }
    public function index(Request $request)
    {	


	    $this->user_id = \Auth::user()->id;
	    
    	$storesByBanner = StoreInfo::getStoreListingByManagerId($this->user_id)->groupBy('banner_id');
        foreach ($storesByBanner as $key => $value) {
            $storesByBanner[$key] = $value->flatten()->pluck('store_number')->toArray();
        }

        $storeGroups = CustomStoreGroup::getStoreGroupsForManager($storesByBanner->flatten()->toArray());

        $today = date("Y") . "-" . date("m");
        $today = (string) $today;

        //for Calendar View
    	$events =  Event::getActiveEventsAndProductLaunchForCalendarViewByStorelist($storesByBanner, $storeGroups);
        
        //for List View
        $eventsList = Event::getListofEventsByStorelistAndMonth($storesByBanner, $storeGroups, $today);

        return view('manager.calendar.index')->with('events', $events)
                                            ->with('today', $today)
                                            ->with('eventsList', $eventsList);
    }

    public function getEventListPartial($yearMonth)
    {
        $this->user_id = \Auth::user()->id;
        
        $storesByBanner = StoreInfo::getStoreListingByManagerId($this->user_id)->groupBy('banner_id');
        foreach ($storesByBanner as $key => $value) {
            $storesByBanner[$key] = $value->flatten()->pluck('store_number')->toArray();
        }

        $storeGroups = CustomStoreGroup::getStoreGroupsForManager($storesByBanner->flatten()->toArray());

        $eventsList = Event::getListofEventsByStoreListAndMonth($storesByBanner, $storeGroups, $yearMonth);
        return view('manager.calendar.event-list-partial')->with('eventsList', $eventsList);
    }
}
