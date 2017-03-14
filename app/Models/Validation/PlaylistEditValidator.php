<?php

namespace App\Models\Validation;

use Illuminate\Database\Eloquent\Model;
use App\Models\Validation\PortalValidator;
use App\Models\Video\PlaylistVideo;

class PlaylistEditValidator extends PortalValidator
{
     protected $rules = [
     				'title' => 'required',
			    	'playlist_videos'  => 'sometimes|exists:videos,id',
                    'remove_videos'  => 'sometimes|exists:videos,id',

    		];

    protected $messages = [
 		'playlist_videos.required' 	=> 'Playlist cannot be empty',
 		'playlist_videos.exists' 	=> 'Invalid video files attached',
        'remove_videos.exists'      => 'Invalid video files attached'
    ];

    public function videoAttachmentValidationRule ($playlist_id, $playlist_videos = null, $remove_videos = null)
    {
    	$attached_videos = PlaylistVideo::where('playlist_id', $playlist_id)
    										->where('deleted_at', null)
    										->get()->pluck('video_id')->toArray();
    	if (isset($remove_videos)) {
    		$attached_videos = array_diff($attached_videos, $remove_videos);
    	}
    	
    	if(isset($playlist_videos)) {
    		foreach ($playlist_videos as $video) {
	    		if(!in_array($video, $attached_videos)) {
	    			array_push($attached_videos , $video);
	    		}
	    	}	
    	}
    	

    	if (count($attached_videos)>0){
    		return ['validation_result' => 'true' ];
    	}
    	return ['validation_result' => 'false' , 'errors' =>  ['videos' => 'playlist cannot be empty']] ;

    }
}
