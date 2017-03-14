<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;
use App\Models\Video\PlaylistVideo;

class PlaylistValidator extends PortalValidator
{
     protected $rules = [
     				'title' => 'required',
			    	'playlist_videos'  => 'required|exists:videos,id'
    		];

    protected $messages = [
 		'playlist_videos.required' 	=> 'Playlist cannot be empty',
 		'playlist_videos.exists' 	=> 'Invalid video files attached'
    ];

}
