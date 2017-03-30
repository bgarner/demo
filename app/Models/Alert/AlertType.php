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
}
