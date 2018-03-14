<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;

class FormActivityLog extends Model
{
    protected $table = 'form_activity_log';

    protected $fillable = ['form_data_id', 'log', 'allow_response'];

    public static function getFormInstanceLog($id)
    {
    	$log = Self::where('form_data_id', $id)->orderBy('created_at', 'desc')->get()->each(function($item){
    		$item->log = unserialize($item->log);
    		$item->sinceSubmitted = Utility::getTimePastSinceDate($item->created_at);
    		$item->prettySubmitted = Utility::prettifyDateWithTime($item->created_at);

            if(isset($item->log["answer_time"])){
                $item->prettySinceAnswerSubmitted = Utility::getTimePastSinceDate($item->log["answer_time"]);
                $item->prettyAnswerSubmitted = Utility::prettifyDateWithTime($item->log["answer_time"]);
            }
    	});

    	return $log;
    }
}
