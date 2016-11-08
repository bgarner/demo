<?php

namespace App\Models\Community;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
	use SoftDeletes;
    protected $table = 'community_donations';
    protected $dates = ['deleted_at'];
    protected $fillable = ['store_number', 'employee_name', 'employee_number', 'event_or_team_name', 'recipient_organization', 'recipient_name', 'recipient_phone', 'recipient_email', 'receipt_date', 'event_date', 'event_location', 'dm_approval', 'notes'];


    public static function store($request)
    {
    	$donation = Donation::create([

    		'store_number' => $request->store_number,
    		'employee_name' => $request->emp_name,
    		'employee_number' => $request->emp_number,
    		'event_or_team_name' => $request->team_event_name,
    		'recipient_organization' => $request->org_name,
    		'recipient_name' => $request->pickup_name,
    		'recipient_phone' => $request->pickup_phone,
    		'recipient_email' => $request->pickup_email,
    		'receipt_date' => $request->pickup_date,
    		'event_date' => $request->event_date,
    		'event_location' => $request->event_location,
    		'dm_approval' => $request->approval,
    		'notes' => $request->notes

 		]);

 		$donation->save();
 		$insertedId = $donation->id;
    	return $insertedId;
    }


}
