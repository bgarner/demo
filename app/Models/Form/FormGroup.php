<?php

namespace App\Models\Form;

use Illuminate\Database\Eloquent\Model;
use App\Models\Form\FormRoleMap;
use App\Models\Auth\User\UserRole;
use App\Models\Form\GroupUser;

class FormGroup extends Model
{
    protected $table = 'form_usergroups';

    protected $fillables = ['form_id', 'group_name'];

    public static function getUserGroupsByFormAndRoleId()
    {

        $forms = FormRoleMap::where('form_role.role_id', \Auth::user()->role_id)->get()->pluck('form_id');

    	return FormGroup::join('forms', 'forms.id', '=', 'form_usergroups.form_id')
    					->whereIn('form_id', $forms)
    					->select('forms.form_label', 'form_usergroups.*' )
    					->get();

    }

    public static function createGroup($request)
    {
        $group = FormGroup::create([

            'form_id' => $request["form_id"],
            'group_name' => $request["group_name"]
        ]);

        GroupUser::createGroupUserPivotByGroupId($request, $group->id);

        return;
    }


}
