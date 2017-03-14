@if( isset($videos) && count($videos)> 0 )
	@foreach($videos as $video)
	
	<div class="video-list-item">
		<input type="checkbox" class="video-checkbox" name = "playlist_videos[]" value = {{$video["id"]}} data-videoid = {{$video["id"]}} data-videoname = "{{$video['title']}}"  > {{$video["title"]}} 
	</div>
	@endforeach
@endif