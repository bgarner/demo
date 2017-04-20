<?php

namespace App\Models\Auth\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Resource\Resource;

class UserResource extends Model
{
    protected $table = 'user_resource';

    protected $fillable = ['user_id', 'resource_id'];

    
    public static function getResourceIdByUserId($user_id)
    {
    	return Self::where('user_id', $user_id)->first()->resource_id;

    }

    public static function getResourceDetailsByUserId($user_id)
    {
    	$resource = Self::join('resources', 'resources.id', '=', 'user_resource.resource_id')
    		// ->join('resource_types', 'resource_types.id', '=', 'resources.resource_type_id')
    		->where('user_id', $user_id)
    		->select('resources.resource_type_id', 'resources.resource_id')
    		->first();

    	if($resource){
    		$resource->resource_name =  Resource::getResourceListByResourceTypeId($resource['resource_type_id'])[$resource->resource_id];	
    	}
    	
    	return $resource;


    }
}
