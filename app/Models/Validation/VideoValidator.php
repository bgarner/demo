<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;

class VideoValidator extends PortalValidator
{
    protected $rules = [
			    	'title' 	          => 'sometimes',
			    	'filename'            => 'required|mimetypes:video/mp4,video/webm',
			    	'target_stores'       => "sometimes|exists:stores,store_number",
			    	'allStores'           => 'sometimes|in:on,off',
			    	'target_banners'      => 'sometimes|exists:banners,id',
			    	'store_groups' => 'sometimes|exists:custom_store_groups,id'

    		];

    protected $messages = [

    ];
}
