<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	use SoftDeletes;
    protected $table = 'community_donated_items';
    protected $dates = ['deleted_at'];
    protected $fillable = ['banner_id', 'title', 'description', 'event_type', 'start', 'end'];
}
