<?php

namespace App\Models\Community;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationType extends Model
{
    use SoftDeletes;
    protected $table = 'community_donation_types';
    protected $dates = ['deleted_at'];
    protected $fillable = ['donation_type'];
}
