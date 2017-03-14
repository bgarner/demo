<?php

namespace App\Models\StoreFeedback;

use Illuminate\Database\Eloquent\Model;

class FeedbackCategoryTypes extends Model
{
    protected $table = 'feedback_category_types'; 

    public static function getFeedbackCategoryList()
    {
    	return FeedbackCategoryTypes::all()->lists('name', 'id')->prepend('');
    }
}
