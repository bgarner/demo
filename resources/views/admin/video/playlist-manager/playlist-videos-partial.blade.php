@if(isset($videos) && count($videos)>0)
	<div class="ibox-content">
	<small>Drag Videos to reorder</small>
		<div class="dd" id="videoplaylist">
			<ol class="dd-list">
				
				@foreach($videos as $video)

				<li class="dd-item" data-id="{{ $video->id }}">
						<span class="pull-left">
							<div class="dd-handle"><i class="fa fa-bars"></i></div>
						</span>
						
						<img src="/video/thumbs/{{ $video->thumbnail }}" height="30" width="30" />
						<span class="client-link" style="margin:0px 10px;">{{ $video->title }}</span>
						<a data-video-id="{{$video->id}}" id="file{{$video->id}}" class="remove-video btn btn-danger btn-sm pull-right" style="margin: 0px 10px;">
							<i class="fa fa-trash"></i>
						</a>
				 </li>
				@endforeach
			</ol>
		</div>
	</div>
@else
	<div class="ibox-content">
		<div class="dd" id="featuredcontentlist">
			<ol class="dd-list">
			</ol>
		</div>
	</div>
@endif