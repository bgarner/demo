<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User\UserRole;
use App\Models\Auth\Group\GroupRole;
use App\Models\StoreApi\StoreInfo;

class Form extends Model
{
    protected $table = 'forms';

    protected $fillable = ['form_name', 'version', 'form_structure'];

    
    public static function getFormList()
    {
        return Form::pluck( 'form_label', 'id');

    }


    public static function getFormsByAdminRoleId()
    {

        $formIds = FormRoleMap::getFormListByRoleId();

        if( \Auth::user()->group_id == 2 ){ 

            $user_id = \Auth::user()->id;
            $storesByBanner = StoreInfo::getStoreListingByManagerId($user_id)->groupBy('banner_id');
            $stores = $storesByBanner->flatten()->pluck('store_number')->toArray();
        }

        $forms = Form::whereIn('id', $formIds)
                    ->select('forms.*')
                    ->get();

        if(isset($stores)) {
            $forms->each(function($form) use($stores) {

                        $form->count_new = FormData::getNewFormInstanceCount($form->id, $stores);
                        $form->count_in_progress = FormData::getInProgressFormInstanceCount($form->id, $stores);
                    });
        }
        else{
            $forms->each(function($form){

                        $form->count_new = FormData::getNewFormInstanceCount($form->id);
                        $form->count_in_progress = FormData::getInProgressFormInstanceCount($form->id);
                    });
        }
                    

        
        return $forms;
    }

    public static function getFormId($formMeta)
    {
    	$formId = Form::where('form_name', $formMeta['name'])
    				->where('version', $formMeta['version'])
    				->first()->id;

    	return $formId;
    }

    public static function getFormListByRoleId()
    {
        $formIds = FormRoleMap::getFormListByRoleId();
        return Form::whereIn('id', $formIds)->pluck('form_label', 'id')->prepend('Select one', '');
    }
    
}
