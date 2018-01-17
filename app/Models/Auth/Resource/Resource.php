<?php

namespace App\Models\Auth\Resource;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Role\RoleResource;
use App\Models\StoreApi\StoreInfo;
use App\Models\Validation\ResourceValidator;

class Resource extends Model
{
    protected $table = 'resources';

    protected $fillable = ['resource_type_id', 'resource_id' ];

    public static function validateResource($request)
    {
        $validateThis = [
            'resource_type' => $request['resource_type'],
            'resource_id' => $request['resource_id'],
            
        ];

        \Log::info($validateThis);
        $v = new ResourceValidator();
          
        return $v->validate($validateThis);
    }

    public static function getResourceDetails()
    {
    	$resources =  Resource::all()->each(function($resource){
    		$resourceDetails = RoleResource::getRoleByResourceTypeId($resource->resource_type_id);
            $resource->role = $resourceDetails['role_name'];
            $resource->resource_name = $resourceDetails['resource_name'];
    	});

        return $resources;
    }

    public static function createResource($request)
    {
    	
    	$validate = Self::validateResource($request);
        if($validate['validation_result'] == 'false') {
            \Log::info(json_encode($validate));
            return $validate;
        }
    	$resource = Self::create([
                		'resource_type_id' => $request['resource_type'],
                		'resource_id' => $request['resource_id']
                	]);
        return $resource;


    }

    public static function editResource($request, $id)
    {
    	$resource = Resource::find($id);

    	$resource['resource_type_id'] = $request['resource_type'];
    	$resource['resource_id'] = $request['resource_id'];

    	$resource->save();
    	return $resource;
    }

    public static function deleteResource($id)
    {
    	Resource::find($id)->delete();
    }

    public static function getNewResourcesByResourceTypeId($id)
    {
    	
        $storeApiResourceList = Self::getResourceListByResourceTypeId($id);
        
        $localResourceList = Resource::where('resource_type_id', $id)->get()->pluck('resource_id')->toArray();
        
        $newResources = array_diff($storeApiResourceList, $localResourceList);
        


        if ( $id == 1) {
            foreach ($newResources as $key=>$resource) {
                $store = StoreInfo::getStoreInfoByStoreId($resource);
                $newResources[$store->store_id] =  $store->store_number . " - " . $store->name;
                unset($newResources[$key]);
            }
        }
        if ( $id == 2) {
            
        }
        if ( $id == 3) {
            
        }

        return $newResources;
        
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
        
        return array_keys($resourceNamesList);
    }

}
