<?php

namespace App\Models\Auth\Resource;

use Illuminate\Database\Eloquent\Model;

class ResourceTypes extends Model
{
    protected $table = 'resource_types';

    public static function getResourceTypeList()
    {
    	return Self::pluck( 'resource_name', 'id')->prepend('Select one' , '');
    }

    public static function getResourceTypeIdByResourceName($resource_name)
    {
    	$resourceTypeId = ResourceTypes::where('resource_name', $this->resource_type)->first()->id;
    	dd($resourceTypeId);
    }

    
}
