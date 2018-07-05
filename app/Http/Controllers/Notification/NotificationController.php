<?php

namespace App\Http\Controllers\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StoreApi\Store;
use App\Models\Utility\Utility;

class NotificationController extends Controller
{
    public function index($store_number)
    {
    	$notifications = Store::where('store_number', $store_number)->first()->unreadNotifications->each(function($item){
            $item->prettyCreatedAt = Utility::getTimePastSinceDate($item->created_at);
        });

        return view('site.includes.notification-partial')->with('notifications', $notifications);
    }
}
