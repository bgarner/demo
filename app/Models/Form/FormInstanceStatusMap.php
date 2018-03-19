<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class FormInstanceStatusMap extends Model
{
    protected $table = 'form_instance_status';
    protected $fillable = ['form_data_id', 'status_code_id'];

    public static function updateFormInstanceStatus($request)
    {
    	$status = $request->status_code_id;
        $formInstanceId = $request->form_instance_id;

        if(FormInstanceStatusMap::where('form_data_id', $formInstanceId)->first()){
        	$formStatus = FormInstanceStatusMap::where('form_data_id', $formInstanceId)->first();
        	$formStatus->status_code_id = $status;
        	$formStatus->save();
        }
        else{
        	
        	$formStatus = FormInstanceStatusMap::create([
	            "form_data_id" => $formInstanceId,
	            "status_code_id" => $status
        	]);	
        }

        return $formStatus;
        
    }

}
