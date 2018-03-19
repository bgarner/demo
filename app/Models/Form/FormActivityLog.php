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

    public static function createFormInstanceActivityLog($request)
    {
        $status = $request->status_code_id;
        $statusMeta = Status::find($status);
        $origin = $request->origin;
        $formInstanceId = $request->form_instance_id;
        $comment = $request->comment;
        $reply = $request->reply;

        switch($origin){
            case "admin":
                $user = \Auth::user();
                $username = $user->firstname . " " . $user->lastname;
                $userposition = $user->fglposition;
                break;

            case "store":
                $username = $request->submitted_by;
                $userposition = $request->submitted_by_position;
                break;
        }
        
        $log = [
            "status_id" => $status,
            "status_admin_name" => $statusMeta->admin_status,
            "status_store_name" => $statusMeta->store_status,
            "status_icon" => $statusMeta->icon,
            "status_colour" => $statusMeta->colour,
            "user_name" => $username,
            "user_position" => $userposition,
            "comment" => $comment
        ];

        \Log::info($log);

        $formLog =FormActivityLog::create([
            "form_data_id" => $formInstanceId,
            "log" => serialize($log),
            "status_id" =>$request->status, 
            "allow_response" => $reply
        ]);

        return $formLog;
    }
}
