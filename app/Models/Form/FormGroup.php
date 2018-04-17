<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Form\GroupUser;
use App\Models\Form\FormGroupMap;
use App\Models\Form\FormRoleMap;
use App\Models\Form\ProductRequest\FormGroupBusinessUnitMap;
class FormGroup extends Model
{
    protected $table = 'form_usergroups';

    protected $fillable = ['group_name'];

    public static function createGroup($request)
    {
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
