<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;

class DonationType extends Model
{
    use SoftDeletes;
    protected $table = 'community_donation_types';
    protected $dates = ['deleted_at'];
    protected $fillable = ['donation_type'];
}
