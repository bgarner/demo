<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;

class FormData extends Model
{
    protected $table = 'form_data';
    protected $fillable = ['form_id', 'store_number', 'submitted_by', 'form_data', 'form_name', 'form_version'];

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
    	$formInstance =  FormData::create([
					            "form_id" => $request->form_id,
					            "store_number" =>$request->storeNumber,
					            "form_name" => $this->form_name,
					            "form_version" => $this->current_version,
					            "submitted_by" => $request->submitted_by,
					            "form_data" => serialize($request->all())
					        ]);

    	return $formInstance;
    }


}
