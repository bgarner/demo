<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	use SoftDeletes;
    protected $table = 'community_donated_items';
    protected $dates = ['deleted_at'];
    protected $fillable = ['donation_type', 'title', 'description', 'value', 'style_number', 'upc'];


    public function store()
    {
    	$item = Item::create([

    		'donation_type'  => $request->donation_type,
    		'description' => $request->product_name,
    		'value' => $request->value,
    		'style_number' => $request->style_number,
    		'upc' => $request->upc

 		]);

 		$item->save();
 		$insertedId = $item->id;
    	return $insertedId;
    }
    
}
