<?php

namespace App\Models\Auth\Role;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreInfo;

class RoleResource extends Model
{
    protected $table = 'role_resource';

    protected $fillable = ['role_id', 'resource_id'];

    public static function getResourcesByRoleId($id)
    {
    	$resources = RoleResource::join('resources', 'role_resource.resource_id', '=', 'resources.id' )
    						->where('role_resource.role_id', $id)
    						->select('resources.id', 'resources.resource_name as resource_type', 'resources.resource_id')
    						->get();
    	
    	$resourceType = $resources[0]->resource_type;
    	$districtNamesList = [];

    	if ( $resourceType == 'district') {
    		$districtNamesList = StoreInfo::getDistrictNamesList();
    	}
    	if ( $resourceType == 'region') {
    		$districtNamesList = StoreInfo::getRegionNamesList();
    	}
        if($resourceType == 'region' || $resourceType == 'district'){
            foreach ($resources as $resource) {
		  	   $resource->resource_name = $districtNamesList[$resource['resource_id']];
    		}
        }
    	
    	return $resources;
    }

}
