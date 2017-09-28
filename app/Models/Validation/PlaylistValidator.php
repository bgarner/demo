<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;
use App\Models\Video\PlaylistVideo;

class PlaylistValidator extends PortalValidator
{
     protected $rules = [
			    	'title'           => 'required',
			    	'playlist_videos' => 'required|exists:videos,id',
			    	'target_stores'   => "sometimes|exists:stores,store_number",
			    	'allStores'       => 'sometimes|in:on,off',
			    	'target_banners'  => 'sometimes|exists:banners,id',
			    	'store_groups'    => 'sometimes|exists:custom_store_groups,id'

    		];

    protected $messages = [
 		'playlist_videos.required' 	=> 'Playlist cannot be empty',
 		'playlist_videos.exists' 	=> 'Invalid video files attached'
    ];

}
