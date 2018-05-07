<?php

namespace App\Models\Auth\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Resource\Resource;

class UserResource extends Model
{
    protected $table = 'user_resource';

    protected $fillable = ['user_id', 'resource_id'];

    
    public static function updateUserResource($user_id, $resource_id)
    {
    	if(isset($resource_id)){
            
            $userResource = Self::where('user_id', $user_id)
                            ->first()
                            ->update(['resource_id' => $resource_id]);
        }    

    	return;
    }

    public static function getResourceIdByUserId($user_id)
    {
    	$userResource = Self::where('user_id', $user_id)->first();
    	if($userResource)
    	{
    		return $userResource->resource_id;
    	}
    	else return null;

    }

    public static function getResourceDetailsByUserId($user_id)
    {
    	$resource = Self::join('resources', 'resources.id', '=', 'user_resource.resource_id')
    		->where('user_id', $user_id)
    		->select('resources.resource_type_id', 'resources.resource_id')
    		->first();

    	if($resource){
    		$resource->resource_name =  Resource::getResourceListByResourceTypeId($resource['resource_type_id'])[$resource->resource_id];	
    	}
    	
    	return $resource;


    }
}
