<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;

class FormInstanceResolutionMap extends Model
{
    protected $table = 'form_instance_resolution_code_map';
    protected $fillable = ['form_instance_id', 'resolution_code_id'];

    public static function updateFormInstanceResolution($form_instance_id, $resolution_code_id)
    {
    	$resolutionCode = $resolution_code_id;
        $formInstanceId = $form_instance_id;

        if(Self::where('form_instance_id', $formInstanceId)->first()){
        	$formResolution = Self::where('form_instance_id', $formInstanceId)->first();
        	$formResolution->resolution_code_id = $resolutionCode;
        	$formResolution->save();
        }
        else{
        	
        	$formResolution = Self::create([
	            "form_instance_id" => $formInstanceId,
	            "resolution_code_id" => $resolutionCode
        	]);	
        }

        return $formResolution;
    }

    public static function getResolutionCodeByFormInstanceId($form_instance_id)
    {
        $resolutionCode = Self::join('form_resolution_code', 'form_resolution_code.id', '=', 'form_instance_resolution_code_map.resolution_code_id')
                    ->where('form_instance_resolution_code_map.form_instance_id', $form_instance_id)
                    ->select('form_resolution_code.id', 'form_resolution_code.resolution_code' )
                    ->first();

        return $resolutionCode;
        
    }
}
