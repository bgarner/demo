<?php

namespace App\Models\Alert;

use Illuminate\Database\Eloquent\Model;

class AlertType extends Model
{
    protected $table = 'alert_types';
    protected $fillable = ['name'];

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
        $alertType = AlertType::create([
                'name'=> $request['alert_type']
            ]);

        return $alertType;
    } 

    public static function updateAlertType($id, $request)
    {
        
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
}
