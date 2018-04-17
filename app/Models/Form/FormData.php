<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use App\Models\Form\Form;

class FormData extends Model
{
    protected $table = 'form_data';
    protected $fillable = ['form_id', 'store_number', 'submitted_by', 'form_data', 'form_name', 'form_version', 'business_unit'];

    public static function getAdminFormDataByFormNameAndVersion($name, $version)
    {
        $form_id = Form::where('form_name', $name)
                        ->where('version', $version)
                        ->first()
                        ->id;
        $forms = FormData::where('form_id', $form_id)->get();
        return $forms;
    }

    public static function getAdminFormDataByFormNameAndVersionAndStore($name, $version, $store_number)
    {

		$form_id = Form::where('form_name', $name)
                        ->where('version', $version)
                        ->first()
                        ->id;

        $forms = FormData::where('form_id', $form_id)
						->where('store_number', $store_number)        				
        				->get();
        return $forms;
    }

    public static function getFormInstanceById($id)
    {
    	$formInstance = FormData::find($id);
        $formInstance->form_data = unserialize( $formInstance->form_data);
        $formInstance->prettySubmitted = Utility::prettifyDateWithTime($formInstance->created_at);
        $formInstance->sinceSubmitted = Utility::getTimePastSinceDate($formInstance->created_at);

        return $formInstance;

    }

    public static function createNewFormInstance($request)
    {
    	$form = Form::find($request->form_id);

        $formInstance =  FormData::create([
					            "form_id" => $request->form_id,
					            "store_number" =>$request->storeNumber,
					            "form_name" => $form->form_name,
					            "form_version" => $form->version,
					            "submitted_by" => $request->submitted_by,
                                "business_unit" => $request->department,
					            "form_data" => serialize($request->all())
					        ]);

        $status_code_id_for_new = Status::where('admin_status', 'new')->first()->id;
        FormInstanceStatusMap::updateFormInstanceStatus($formInstance->id, $status_code_id_for_new);
    	return $formInstance;
    }

    public static function getNewFormInstanceCount($form_id)
    {
        return FormData::join('form_instance_status', 'form_instance_status.form_data_id', '=', 'form_data.id')
                                        ->where('form_id', $form_id)
                                        ->where('form_instance_status.status_code_id', 1)
                                        ->select('form_data.*')
                                        ->count();
    }

    public static function getInProgressFormInstanceCount($form_id)
    {
        return FormData::join('form_instance_status', 'form_instance_status.form_data_id', '=', 'form_data.id')
                                        ->where('form_id', $form_id)
                                        ->whereNotIn('form_instance_status.status_code_id', [1, 5])
                                        ->select('form_data.*')
                                        ->count();
    }

    public static function getFormInstancesByBusinessUnitId($business_unit)
    {
        return FormData::where('business_unit_id', $business_unit)
                        ->select('*')
                        ->get()
                        ->each(function($form) {
                            $form->form_data = unserialize($form->form_data);
                        });


    }

}
