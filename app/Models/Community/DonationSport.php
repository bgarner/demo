<?php

namespace App\Models\Community;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationSport extends Model
{
    use SoftDeletes;
    protected $table = 'community_donation_sports';
    protected $dates = ['deleted_at'];
    protected $fillable = ['sport'];
}
