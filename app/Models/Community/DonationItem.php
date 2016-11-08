<?php

namespace App\Models\Community;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationItem extends Model
{
    //community_donations_items
    use SoftDeletes;
    protected $table = 'community_donations_items';
    protected $dates = ['deleted_at'];
    protected $fillable = ['donation_id', 'item_id'];


    public static function store($donation_id, $item_id)
    {
    	$donation_item = DonationItem::create([

    		'donation_id' => $donation_id,
    		'item_id' => $item_id

 		]);

 		$donation_item->save();
    }    
}
