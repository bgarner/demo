<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;

class DonationSport extends Model
{
    use SoftDeletes;
    protected $table = 'community_donation_sports';
    protected $dates = ['deleted_at'];
    protected $fillable = ['sport'];
}
