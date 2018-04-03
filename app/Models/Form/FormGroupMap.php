<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Form\FormRoleMap;
use App\Models\Auth\User\UserRole;
use App\Models\Utility\Utility;

class FormGroupMap extends Model
{
    protected $table = 'form_usergroup_map';

    protected $fillable = ['form_id', 'form_group_id'];

    public static function getUserGroupsByFormAndRoleId()
    {

        $forms = FormRoleMap::where('form_role.role_id', \Auth::user()->role_id)->get()->pluck('form_id');

    	return FormGroupMap::join('forms', 'forms.id', '=', 'form_usergroup_map.form_id')
    					->join('form_usergroups', 'form_usergroups.id', 'form_usergroup_map.form_group_id')
    					->whereIn('form_id', $forms)
    					->select('forms.form_label', 'form_usergroups.*' )
    					->get();

    }

    public static function updateGroupFormPivotByGroupId($form_id, $group_id)
    {
    	
    	FormGroupMap::where('form_group_id', $group_id)->delete();
    	FormGroupMap::create([
    			'form_group_id' => $group_id,
    			'form_id'	    => $form_id
    		]);
    }

    public static function getPossibleUsersFormFormGroup($group_id)
    {

        $form_id = FormGroupMap::where('form_group_id', $group_id)->first()->form_id;
        $roles =  FormRoleMap::getRoleListByFormId($form_id);
        $users = UserRole::getFormUsersByRoleList($roles);    
        $users = Utility::formatUsersList($users);
     	return $users;
    }
}
