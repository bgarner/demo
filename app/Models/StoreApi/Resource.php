<?php

namespace App\Models\StoreApi;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'resources';
    protected $fillable = ['resource_type_id', 'resource_id'];

    public static function createResource($resource_type_id, $resource_id)
    {
    	\Log::info($resource_type_id);
    	\Log::info($resource_id)

    	$resource = Self::create([
    		'resource_type_id' => $resource_type_id, 
    		'resource_id'=> $resource_id
    	]);


    } 
}
