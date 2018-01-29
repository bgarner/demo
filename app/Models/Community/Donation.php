<?php

namespace App\Models\Community;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Community\Item;
use App\Models\Community\DonationItem;
use App\Models\Community\DonationType;
use App\Models\Utility\Utility;

class Donation extends Model
{
	use SoftDeletes;
    protected $table = 'community_donations';
    protected $dates = ['deleted_at'];
    protected $fillable = ['store_number', 'employee_name', 'employee_number', 'event_or_team_name', 'sport_category', 'recipient_organization', 'recipient_name', 'recipient_phone', 'recipient_email', 'receipt_date', 'event_date', 'event_location', 'dm_approval', 'notes'];


    public static function store($request)
    {
    	$donation = Donation::create([
    		'store_number' => $request->store_number,
    		'employee_name' => $request->emp_name,
    		'employee_number' => $request->emp_number,
    		'event_or_team_name' => $request->team_event_name,
            'sport_category' => $request->sport_category,
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
        foreach($donations as $donation){

            $donation->amount = self::getDonationValue( $donation->id );
            $donation->amount = "$ " . number_format(floatval($donation->amount), 2, '.', ',');
            $donation->donation_type = self::getDonationType( $donation->id );
            $donation->donation_details = Self::getDonationDetails($donation->id);
            $donation->pretty_created_at = Utility::prettifyDate($donation->created_at);

        }
        return $donations;
    }

    public static function getDonationValue($id)
    {
        $amount = DonationItem::join('community_donated_items', 'community_donated_items.id', '=', 'community_donations_items.item_id')
                            ->where('donation_id', $id)
                            ->select('community_donated_items.*')
                            ->sum('value');  
        return $amount;   
    }

    public static function getDonationDetails($id)
    {
        return DonationItem::join('community_donated_items', 'community_donated_items.id', '=', 'community_donations_items.item_id')
                            ->where('donation_id', $id)
                            ->select('community_donated_items.*')
                            ->get();
    }

    public static function getDonationType($id)
    {
        $item = Self::getDonationDetails($id);
        
        $type = $item[0]["donation_type"];
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
        $totalDonation = "$ " . number_format($totalDonation, 2, '.', ',');
        return $totalDonation;
    }


}
