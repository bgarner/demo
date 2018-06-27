<?php

namespace App\Models\Form\ProductRequest;

use Illuminate\Database\Eloquent\Model;
use App\Models\Utility\Utility;
use App\Models\Form\Form;
use App\Models\Form\FormData;
use App\Models\Form\FormActivityLog;
use App\Models\Form\FormInstanceUserMap;
use App\Models\Form\FormInstanceGroupMap;
use App\Models\Form\FormInstanceStatusMap;
use App\Models\Form\FormResolution;
use App\Models\Form\FormInstanceResolutionMap;
use App\Models\Form\ProductRequest\BusinessUnitTypes;


class ProductRequestForm extends Model
{

	public function prepareFormInstanceData($forms){

		foreach($forms as $formInstance){

			$formInstance->form_data = unserialize($formInstance->form_data);                            
            $formInstance->requirement = $formInstance->form_data['requirement'];

            switch($formInstance->requirement){
                case "Replenishment-More":
                    $label = "Replenishment";
                    $icon = "fa-plus-circle";
                    $color = "label-more";
                break;
                case "Replenishment-Less":
                    $label = "Replenishment";
                    $icon = "fa-minus-circle";
                    $color = "label-less";
                break;

                case "Assortment-StyleRequest":
                    $label = "Assortment - Style Request";
                    $icon = "fa-question-circle";
                    $color = "label-primary";
                break;

                case "Assortment-Collection/New Assortment":
                    $label = "Assortment - Collection/New Assortment";
                    $icon = "fa-question-circle";
                    $color = "label-primary";
                break;

                default:
                    $label = "Replenishment";
                    $icon = "fa-plus-circle";
                    $color = "label-primary";
                break;
            }

            $formInstance->requirement = "<span class='label ".$color."'><i class='fa ".$icon."' aria-hidden='true'></i> ". $label . "</span>";
            $formInstance->description = $formInstance->form_data['department'] . " > " . $formInstance->form_data['category'] . " > " . $formInstance->form_data['subcategory'] . " > " . $formInstance->form_data['gender'];
            $formInstance->longDesc = $formInstance->form_data['description'];
            $formInstance->comments = $formInstance->form_data['comments'];
            $formInstance->prettySubmitted = Utility::prettifyDateWithTime($formInstance->created_at);
            $formInstance->since = Utility::getTimePastSinceDate($formInstance->created_at);
            $formInstance->assignedToUser = FormInstanceUserMap::getUserByFormInstanceId($formInstance->id);
            $formInstance->assignedToGroup = FormInstanceGroupMap::getGroupByFormInstanceId($formInstance->id);


            $formInstance->lastFormAction = FormActivityLog::getLastFormInstanceAction($formInstance->id);
            if($formInstance->lastFormAction){
                $formInstance->lastActionPrettyDate = Utility::prettifyDateWithTime($formInstance->lastFormAction->updated_at);
                $formInstance->lastActionSince = Utility::getTimePastSinceDate($formInstance->lastFormAction->updated_at);
                $formInstance->status_id = FormInstanceStatusMap::getFormStatusByInstanceId($formInstance->id);
                $resolution = FormInstanceResolutionMap::getResolutionCodeByFormInstanceId($formInstance->id);
                $formInstance->resolutionCode = $resolution['resolution_code'];    
            }
            
            
		}
		 
		return $forms;                      
	}

}