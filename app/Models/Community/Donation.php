<?php

namespace App\Models\Community;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
	use SoftDeletes;
    protected $table = 'community_donations';
    protected $dates = ['deleted_at'];
    protected $fillable = ['store_number', 'employee_name', 'employee_number', 'event_or_team_name', 'recipient_organization', 'recipient_name', 'recipient_phone', 'recipient_email', 'receipt_date', 'event_date', 'event_location', 'dm_approval'];
}
