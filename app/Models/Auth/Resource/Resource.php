<?php

namespace App\Models\Auth\Resource;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Role\RoleResource;
use App\Models\StoreInfo;

class Resource extends Model
{
    protected $table = 'resources';

    public static function getResourceDetails()
    {
    	return Resource::all()->each(function($resource){
    		$resource->roles = RoleResource::getRoleByResourceId($resource->id);
    	});
    }

    public static function createResource($request)
    {
    	
    	//validate resource
    	Self::create([
    		'resource_name' => $request['resource_name'],
    		'resource_id' => $request['resource_id']
    	]);
    }

    public static function editResource($request, $id)
    {
    	$resource = Resource::find($id);

    	$resource['resource_name'] = $request['resource_name'];
    	$resource['resource_id'] = $request['resource_id'];

    	$resource->save();
    	return $resource;
    }

    public static function deleteResource($id)
    {
    	RoleResource::where('resource_id', $id)->delete();
    	RoleResource::find($id)->delete();
    }

    public static function getNewResourcesByResourceTypeId($id)
    {
    	//get store/district/region listing from storeInfo
    	//check if they already exist in Resource table
    	//return the list of non existing ones.
    }

    public static function getResourceListByResourceTypeId($id)
    {
        $resourceNamesList = [];

        if ( $id == 1) {
            $resourceNamesList = StoreInfo::getStoreNamesList();
    
        }
        if ( $id == 2) {
            $resourceNamesList = StoreInfo::getDistrictNamesList();
        }
        if ( $id == 3) {
            $resourceNamesList = StoreInfo::getRegionNamesList();
        }
        
        return $resourceNamesList;
    }

}
