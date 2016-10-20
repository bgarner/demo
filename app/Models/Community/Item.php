<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	use SoftDeletes;
    protected $table = 'community_donated_items';
    protected $dates = ['deleted_at'];
    protected $fillable = ['donation_type', 'title', 'description', 'value', 'style_number', 'upc'];
    
}
