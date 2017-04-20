<?php

namespace App\Models\Auth\Role;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreInfo;
use App\Models\Auth\Resource\Resource;

class RoleResource extends Model
{
    protected $table = 'role_resource';

    protected $fillable = ['role_id', 'resource_id'];

    public static function getResourcesByRoleId($id)
    {
    	// $resources = RoleResource::join('resources', 'role_resource.resource_id', '=', 'resources.id' )
    	// 					->where('role_resource.role_id', $id)
    	// 					->select('resources.id', 'resources.resource_name as resource_type', 'resources.resource_id')
    	// 					->get();
    	
    	// $resourceType = $resources[0]->resource_type;
    	// $districtNamesList = [];

     //    if ( $resourceType == 'store') {
     //        $districtNamesList = StoreInfo::getStoreNamesList();
     //        foreach ($resources as $resource) {
     //           $resource->resource_name = $resource['resource_id'] . " - " . $districtNamesList[$resource['resource_id']];
     //        }
     //    }
    	// if ( $resourceType == 'district') {
    	// 	$districtNamesList = StoreInfo::getDistrictNamesList();
    	// }
    	// if ( $resourceType == 'region') {
    	// 	$districtNamesList = StoreInfo::getRegionNamesList();
    	// }
     //    if($resourceType == 'region' || $resourceType == 'district' ){
     //        foreach ($resources as $resource) {
		  	//    $resource->resource_name = $districtNamesList[$resource['resource_id']];
    	// 	}
     //    }


    	
    	// return $resources;



        $resource_type_id = RoleResource::where('role_resource.role_id', $id)->first()->resource_type_id;

        $resources = Resource::join('resource_types', 'resource_types.id', '=', 'resources.resource_type_id')
                            ->where('resources.resource_type_id', $resource_type_id)
                            ->select('resources.id', 'resources.resource_type_id', 'resources.resource_id')
                            ->get();
        
        $districtNamesList = [];

        $finalResourceList = [];

        if ( $resource_type_id == 1) {
            $districtNamesList = StoreInfo::getStoreNamesList();
            foreach ($resources as $resource) {
                $finalResourceList[$resource['id']] = $resource['resource_id'] . " - " . $districtNamesList[$resource['resource_id']];
            }
        }
        if ( $resource_type_id == 2) {
            $districtNamesList = StoreInfo::getDistrictNamesList();
        }
        if ( $resource_type_id == 3) {
            $districtNamesList = StoreInfo::getRegionNamesList();
        }
        if($resource_type_id == 2 || $resource_type_id == 3 ){
            foreach ($resources as $resource) {
               $finalResourceList[$resource['id']] = $districtNamesList[$resource['resource_id']];
            }
        }


        
        return $finalResourceList;


    }

    public static function getRoleByResourceId($id)
    {
        $roles = RoleResource::join('roles', 'role_resource.role_id', '=', 'roles.id' )
                            ->where('role_resource.resource_id', $id)
                            ->select('roles.id', 'roles.role_name')
                            ->get();
    
        
        return $roles;
    }

}
