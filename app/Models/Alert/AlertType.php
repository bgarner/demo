<?php

namespace App\Models\Alert;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\AlertTypeValidator;

class AlertType extends Model
{
    protected $table = 'alert_types';
    protected $fillable = ['name'];


    public static function validateAlertType($request)
    {
        $validateThis = [
                            'alert_type' => $request['alert_type']
                        ];

        $v = new AlertTypeValidator();
        return $v->validate($validateThis);
    }


    public static function getAlertTypesByStoreNumber($request, $storeNumber)
    {
    	$alertTypes = AlertType::all();
        

        if (isset($request['archives']) && !empty($request['archives'])) {
            foreach($alertTypes as $at){
                $at->count = Alert::getAllAlertCountByCategory($storeNumber, $at->id);
            }  

        }
        else{

        	foreach($alertTypes as $at){
	            $at->count = Alert::getActiveAlertCountByCategory($storeNumber, $at->id);
	        } 
        }
            
        // dd($alertTypes);
        return $alertTypes;  
    }

    public static function isValidAlertType($id)
    {
        if(isset($id) && !empty($id) && AlertType::find($id)){
            return true;
        }
        else{
            return false;
        }
    }


    public static function createAlertType($request)
    {
        $validate = AlertType::validateAlertType($request);

        if($validate['validation_result'] == 'false') {
          \Log::info($validate);
          return json_encode($validate);
        }

        $alertType = AlertType::create([
                'name'=> $request['alert_type']
        ]);

        return $alertType;
    } 

    public static function updateAlertType($id, $request)
    {
        $validate = AlertType::validateAlertType($request);

        if($validate['validation_result'] == 'false') {
          \Log::info($validate);
          return json_encode($validate);
        }

        $alertType = AlertType::find($id);
        $alertType['name'] = $request['alert_type'];
        $alertType->save();
    }  
    public static function getAllAlertTypes()
    {
        $alertTypes = AlertType::all();
        foreach ($alertTypes as $at) {
            
            $at->alertCount = Alert::where('alert_type_id', $at->id)->get()->count();
        }

        return $alertTypes;

    }
    public static function getAlertTypesByStorelist($alerts)
    {
        $groupedAlerts = $alerts->groupBy('alert_type_id');
        $alertTypeIds = $groupedAlerts->keys();
        $alertTypes = AlertType::whereIn('id', $alertTypeIds)
                              ->get()
                              ->each(function($alertType) use($groupedAlerts){
                                $alertType->count = count($groupedAlerts[$alertType->id]);
                            });

        return $alertTypes;
        
    }
    public static function getAlertCategoryName($id)
    {
        if(isset($id) && !empty($id)){

            if( AlertType::find($id) ){
                return AlertType::find($id)->name;
            }
        }

    }
}
