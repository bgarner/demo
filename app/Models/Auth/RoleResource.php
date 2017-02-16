<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class RoleResource extends Model
{
    protected $table = 'role_resource';

    protected $fillable = ['role_id', 'resource_id'];

    public static function getResourcesByRoleId($id)
    {
    	$resources = RoleResource::join('resources', 'role_resource.resource_id', '=', 'resources.id' )
    						->where('role_resource.role_id', $id)
    						->select('resources.*')
    						->get();

    	return $resources;
    }
}
