<?php

namespace App\Models\Community;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Community\DonationItem;

class Item extends Model
{
	use SoftDeletes;
    protected $table = 'community_donated_items';
    protected $dates = ['deleted_at'];
    protected $fillable = ['donation_type', 'title', 'description', 'value', 'style_number', 'upc'];


    public static function store($request, $donation_id)
    {
    	switch($request->donationtype){
    		case "giftcard":
    			foreach ($request->giftcards as $giftcard) {

                    \Log::info($giftcard);
                    $type = 1;
                    $value = $giftcard["gc_value"];
                    $description = "giftcard";
                    $style = $giftcard["gc_number"];
                    $upc = "0";

                    $item = Item::create([

                        'donation_type'  => $type,
                        'description' => $description,
                        'value' => $value,
                        'style_number' => $style,
                        'upc' => $upc

                    ]); 

                    DonationItem::store($donation_id, $item->id);
                }
    			
    			break;
    		case "product":
    			foreach ($request->products as $product) {
                    $type =2;
                    $value = $product["product_value"];
                    $description = $product["product_name"];
                    $style = $product["style_number"];
                    $upc = $product["upc"];
                           
        			$item = Item::create([

                        'donation_type'  => $type,
                        'description' => $description,
                        'value' => $value,
                        'style_number' => $style,
                        'upc' => $upc

                    ]);

                    DonationItem::store($donation_id, $item->id);

                }
    			break;
    		default:
    			$type=1;
    			$value = 0;
    			$description = "";
    			$style = "";
    			$upc = 0;    			
    			break;
    	}

    	

        

    }
    
}
