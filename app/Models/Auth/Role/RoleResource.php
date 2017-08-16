<?php

namespace App\Models\Auth\Role;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreApi\StoreInfo;
use App\Models\Auth\Resource\Resource;

class RoleResource extends Model
{
    protected $table = 'role_resource';

    protected $fillable = ['role_id', 'resource_type_id'];

    public static function getResourcesByRoleId($id)
    {
    	

        $resource_type = RoleResource::where('role_resource.role_id', $id)->first();

        $districtNamesList = [];

        $finalResourceList = [];
        if($resource_type) {
            $resource_type_id  = $resource_type->resource_type_id;
            $resources = Resource::join('resource_types', 'resource_types.id', '=', 'resources.resource_type_id')
                            ->where('resources.resource_type_id', $resource_type_id)
                            ->select('resources.id', 'resources.resource_type_id', 'resources.resource_id')
                            ->get();
        
            

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
        }
        


        
        return $finalResourceList;


    }

    public static function getRoleByResourceTypeId($id)
    {
        $roles = RoleResource::join('resource_types', 'resource_types.id', '=', 'role_resource.resource_type_id')
                            ->join('roles', 'role_resource.role_id', '=', 'roles.id' )
                            ->where('role_resource.resource_type_id', $id)
                            // ->select('roles.id', 'roles.role_name')
                            ->first();
    
        return $roles;
    }


    public static function getResourceTypeIdByRoleId($role_id)
    {
        $roleResource =  RoleResource::where('role_id', $role_id)->first();
        if($roleResource)
        {
            return $roleResource->resource_type_id;
        }
        else return null;
    }


    public static function createRoleResourceTypePivotWithRoleId($role, $request)
    {
        RoleResource::create([
            'role_id' => $role->id,
            'resource_type_id' => $request->resource_type

        ]); 
    
    }
    public static function editRoleResourceTypePivotWithRoleId($role, $request)
    {
        RoleResource::where('role_id', $role->id)->delete();
        if(isset($request->resource_type)){
            RoleResource::create([
                'role_id' => $role->id,
                'resource_type_id' => $request->resource_type

            ]);
        }
    }
    

}
