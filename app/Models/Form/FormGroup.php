<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Form\GroupUser;
use App\Models\Form\FormGroupMap;
use App\Models\Form\FormRoleMap;
use App\Models\Form\ProductRequest\FormGroupBusinessUnitMap;
use App\Models\Validation\Form\ProductRequestGroupValidator;
class FormGroup extends Model
{
    protected $table = 'form_usergroups';

    protected $fillable = ['group_name'];

    public static function validateFormGroup($request)
    {
        $validateThis = [
                            
                            "group_name"   => $request->group_name,
                            "users"        => $request->users,
                            "businessUnit" => $request->businessUnit

                        ]; 
        if(isset($request->form_id)){
            $validateThis["form_id"]    = $request->form_id;
        }
                        

        \Log::info($validateThis);
        $groupValidator = new ProductRequestGroupValidator();

        return $groupValidator->validate($validateThis);
    }

    public static function createGroup($request)
    {
        $validate = Self::validateFormGroup($request);

        if($validate['validation_result'] == 'false') {
          return json_encode($validate);
        }

        $group = FormGroup::create([

            'group_name' => $request["group_name"]

        ]);

        FormGroupMap::updateGroupFormPivotByGroupId($request->form_id, $group->id);
        FormGroupBusinessUnitMap::updateGroupBUPivotByGroupId($request->businessUnit, $group->id);
        GroupUser::updateGroupUserPivotByGroupId($request->users, $group->id);

        return $group;
    }

    public static function editGroup($request, $id)
    {
        $validate = Self::validateFormGroup($request);

        if($validate['validation_result'] == 'false') {
          return json_encode($validate);
        }

        $group = FormGroup::find($id);
        $group['group_name'] = $request["group_name"];
        $group->save();
        
        GroupUser::updateGroupUserPivotByGroupId($request->users, $group->id);
        FormGroupBusinessUnitMap::updateGroupBUPivotByGroupId($request->businessUnit, $group->id);
        return $group;
    }

    public static function deleteGroup($id)
    {
        FormGroupMap::where('form_group_id', $id)->delete();
        GroupUser::where('form_group_id', $id)->delete();
        FormGroupBusinessUnitMap::where('group_id', $id)->delete();
        FormGroup::where('id', $id)->delete();    
    }

    public static function getGroupDetailsByFormGroupId($group_id)
    {   
        $group = FormGroup::find($group_id);
        $group->setAttribute("users", FormGroupMap::getPossibleUsersForFormGroup($group_id));
        $group->setAttribute("selected_users", GroupUser::getUsersByGroupId($group_id));

        return $group;
    }

    
}
