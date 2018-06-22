<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use Carbon\Carbon;
use App\Notifications\ProductRequestFormResponse;
use App\Models\StoreApi\Store;

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


        $formLog =FormActivityLog::create([
            "form_data_id" => $formInstanceId,
            "log" => serialize($log),
            "status_id" =>$request->status, 
            "allow_response" => $reply
        ]);

        if($reply){ //if reply required => generate notification for store
            $formInstanceData = FormData::find($formInstanceId);
            
            $store = Store::where('store_number', $formInstanceData->store_number)->get();
            \Notification::send($store, new ProductRequestFormResponse( 
                [
                    'form_instance_id' => $formInstanceId, 
                    'notification_text' => 'Response required on a Product Request', 
                    'url' => $formInstanceData->store_number. "/form/productrequest/". $formInstanceId
                ] ));
        }

        return $formLog;
    }

    public static function updateFormInstanceActivityLog($id, $request)
    {
        $formActivityInstance = FormActivityLog::find($id);

        $log = unserialize($formActivityInstance->log);

        $log["answer_submitted_by"] = $request->submitted_by;
        $log["answer_submitted_by_position"] = $request->submitted_by_position;
        $log["answer"] = $request->answer;
        $log["answer_time"] = Carbon::now()->toDateTimeString();

        $formActivityInstance->allow_response = null;

        $formActivityInstance->log = serialize($log);
        $formActivityInstance->save();

        // mark notification as read
        if(isset($request->answer) && $request->answer != ''){
            
            $formInstanceData = FormData::find($request->formInstanceId);
            $store = Store::where('store_number', $formInstanceData->store_number)->first();
            $notifications = $store->unreadNotifications->filter(function ($value, $key) use ($request) {
                    return $value->data['form_instance_id'] == $request->formInstanceId;
                });

            $notifications->markAsRead();

        }

        return $formActivityInstance;
    }

    public static function getLastFormInstanceAction($formInstanceId)
    {
        $lastAction = Self::where('form_data_id', $formInstanceId)->orderBy('created_at', 'desc')->first();
        if($lastAction){
            $lastAction->log = unserialize($lastAction->log);    
        }
        
        return $lastAction;
    }
}
