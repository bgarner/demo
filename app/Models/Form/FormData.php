<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use App\Models\Form\Form;
use App\Models\Form\FormActivityLog;
use App\Models\Form\ProductRequest\ProductRequestForm;
use App\Models\Form\ProductRequest\BusinessUnitTypes;
use App\Models\Validation\Form\ProductRequestFormInstanceValidator;

class FormData extends Model
{
    protected $table = 'form_data';
    protected $fillable = ['form_id', 'store_number', 'submitted_by', 'form_data', 'form_name', 'form_version', 'business_unit_id', 'json_form_data'];
    protected static $new_request_status_code_id = 1;
    protected static $closed_request_status_code_id = 5;

    public static function validateFormInstance($request)
    {
        $validateThis = [
                            "department"            => $request->department,
                            "category"              => $request->category,
                            "requirement"           => $request->requirement,
                            "form_id"               => $request->form_id,
                            "store_number"          => $request->storeNumber,
                            "submitted_by"          => $request->submitted_by,
                            "submitted_by_position" => $request->submitted_by_position

                        ]; 

        \Log::info($validateThis);
        $productRequestValidator = new ProductRequestFormInstanceValidator();

        return $productRequestValidator->validate($validateThis);
    }

    public static function getAdminFormDataByFormNameAndVersion($form_name, $form_version)
    {
        $form_id = Form::where('form_name', $form_name)
                        ->where('version', $form_version)
                        ->first()
                        ->id;
        $forms = FormData::where('form_id', $form_id)->get();
        return $forms;
    }

    public static function getFormData($formMeta)
    {
		$form_id = Form::where('form_name', $formMeta['name'])
                        ->where('version', $formMeta['version'])
                        ->first()
                        ->id;

        $forms = FormData::where('form_id', $form_id)
						->where('store_number', $formMeta['store_number'])        				
        				->orderBy('created_at', 'desc')
                        ->get();

        $modelInstance = new $formMeta['model'];

        $forms = $modelInstance->prepareFormInstanceData($forms);

        return $forms;
    }

    public static function getAdminFormDataByFormIdAndStoreList($form_id, $stores)
    {

       
        $forms = FormData::where('form_id', $form_id)
                        ->whereIn('store_number', $stores)                      
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->each(function($formInstance){
                            $formInstance->form_data = unserialize($formInstance->form_data);
                            $formInstance->description = $formInstance->form_data['department'] . " > " . $formInstance->form_data['category'] . " > " . $formInstance->form_data['subcategory'] . ' > '. $formInstance->form_data['requirement'];
                            $formInstance->prettySubmitted = Utility::prettifyDateWithTime($formInstance->created_at);
                            $formInstance->assignedToUser = FormInstanceUserMap::getUserByFormInstanceId($formInstance->id);

                            $formInstance->assignedToGroup = FormInstanceGroupMap::getGroupByFormInstanceId($formInstance->id);

                            $formInstance->lastFormAction = FormActivityLog::getLastFormInstanceAction($formInstance->id);

                        });
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
    	
        \Log::info($request->all());
        $validate = Self::validateFormInstance($request);

        if($validate['validation_result'] == 'false') {
          return json_encode($validate);
        }

        $form = Form::find($request->form_id);
        $business_unit_id = BusinessUnitTypes::where('business_unit', $request->department)->first()->id;

        $formInstance =  FormData::create([
					            "form_id" => $request->form_id,
					            "store_number" =>$request->storeNumber,
					            "form_name" => $form->form_name,
					            "form_version" => $form->version,
					            "submitted_by" => $request->submitted_by,
                                "business_unit_id" => $business_unit_id,
					            "form_data" => serialize($request->all()),
                                "json_form_data" =>json_encode($request->all())
					        ]);

        FormInstanceStatusMap::updateFormInstanceStatus($formInstance->id, Self::$new_request_status_code_id);
        
        return $formInstance;
    }

    public static function getNewFormInstanceCount($form_id, $stores = null)
    {
        return FormData::join('form_instance_status', 'form_instance_status.form_data_id', '=', 'form_data.id')
                                        ->where('form_id', $form_id)
                                        ->where('form_instance_status.status_code_id', Self::$new_request_status_code_id)
                                        ->when($stores, function($query) use ($stores) {
                                            return $query->whereIn( 'form_data.store_number' , $stores);
                                        })
                                        ->select('form_data.*')
                                        ->count();
    }

    public static function getInProgressFormInstanceCount($form_id, $stores = null)
    {
        return FormData::join('form_instance_status', 'form_instance_status.form_data_id', '=', 'form_data.id')
                                        ->where('form_id', $form_id)
                                        ->whereNotIn('form_instance_status.status_code_id', [Self::$new_request_status_code_id, Self::$closed_request_status_code_id])
                                        ->when($stores, function($query) use ($stores) {
                                            return $query->whereIn( 'form_data.store_number' , $stores);
                                        })
                                        ->select('form_data.*')
                                        ->count();
    }

    public static function getFormInstancesByBusinessUnitId($business_unit)
    {
        return FormData::where('business_unit_id', $business_unit)
                        ->select('*')
                        ->orderBy('created_at', 'desc')
                        ->get()
                        ->each(function($formInstance) {
                            $formInstance->form_data = unserialize($formInstance->form_data);
                            $formInstance->description = $formInstance->form_data['department'] . " > " . $formInstance->form_data['category'] . " > " . $formInstance->form_data['subcategory'] . " > " . $formInstance->form_data['gender'] . ">" . $formInstance->form_data['requirement'];
                            $formInstance->prettySubmitted = Utility::prettifyDateWithTime($formInstance->created_at);
                            $formInstance->assignedToUser = FormInstanceUserMap::getUserByFormInstanceId($formInstance->id);

                            $formInstance->assignedToGroup = FormInstanceGroupMap::getGroupByFormInstanceId($formInstance->id);

                            $formInstance->lastFormAction = FormActivityLog::getLastFormInstanceAction($formInstance->id);

                        });


    }

}
