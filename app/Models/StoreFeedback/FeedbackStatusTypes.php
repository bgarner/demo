<?php

namespace App\Models\StoreFeedback;

use Illuminate\Database\Eloquent\Model;

class FeedbackStatusTypes extends Model
{
    protected $table = 'feedback_status_types';

    public static function getFeedbackStatusList()
    {
    	return FeedbackStatusTypes::all()->pluck('name', 'id')->prepend('');
    }
}
