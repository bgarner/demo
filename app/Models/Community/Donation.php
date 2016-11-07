<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
	use SoftDeletes;
    protected $table = 'community_donations';
    protected $dates = ['deleted_at'];
    protected $fillable = ['store_number', 'employee_name', 'employee_number', 'event_or_team_name', 'recipient_organization', 'recipient_name', 'recipient_phone', 'recipient_email', 'receipt_date', 'event_date', 'event_location', 'dm_approval', 'notes'];


    public function store()
    {
    	$donation = Donation::create([

    		'store_number' => $request->store_number,
    		'employee_name' => $request->employee_name,
    		'employee_number' => $request->employee_number,
    		'event_or_team_name' => $request->event_or_team_name,
    		'recipient_organization' => $request->recipient_organization,
    		'recipient_name' => $request->recipient_name,
    		'recipient_phone' => $request->recipient_phone,
    		'recipient_email' => $request->recipient_email,
    		'receipt_date' => $request->receipt_date,
    		'event_date' => $request->event_date,
    		'event_location' => $request->event_location,
    		'dm_approval' => $request->dm_approval,
    		'notes' => $request->notes

 		]);

 		$donation->save();
 		$insertedId = $donation->id;
    	return $insertedId;
    }


}
