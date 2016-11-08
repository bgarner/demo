<?php

namespace App\Models\Community;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Community\Item;
use App\Models\Community\DonationItem;
use App\Models\Community\DonationType;

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

    public static function getDonations($store_number)
    {
        $donations = Donation::where('store_number', $store_number)->get();

        $i = 0;
        foreach($donations as $donation){

            if($i%2){
                $donation->evenodd = "even";
            } else {
                $donation->evenodd = "odd";
            }

            $donation->amount = self::getDonationValue( $donation->id );
            $donation->amount = "$ " . money_format('%i', $donation->amount);
            $donation->donation_type = self::getDonationType( $donation->id );

            $i++;
        }
        return $donations;
    }

    public static function getDonationValue($id)
    {
        $item = DonationItem::where('donation_id', $id)->get();
        $item_details = Item::where('id', $item[0]->item_id)->get();
        $amount = $item_details[0]->value;
        return $amount;       
    }

    public static function getDonationType($id)
    {
        $item = DonationItem::where('donation_id', $id)->get();
        $item_details = Item::where('id', $item[0]->item_id)->get();
        $type = $item_details[0]->donation_type;
        switch($type){
            case 1:
                $donation_type = "Gift Card";
                break;
            case 2:
                $donation_type = "Product";
                break;
            default:
                $donation_type = "";
                break;
        }
        return $donation_type;       
    }

    public static function getTotalDonationforStore($store_number)
    {
        $totalDonation = 0;
        $donations = Donation::where('store_number', $store_number)->get();
        foreach( $donations as $donation ){
            $donation_value = self::getDonationValue( $donation->id );

            $totalDonation = $totalDonation + $donation_value;
        }
        $totalDonation = "$ " . money_format('%i', $totalDonation);
        return $totalDonation;
    }


}
