@if(isset($videos) && count($videos)>0)
	<div class="ibox-content">
	<small>Drag Videos to reorder</small>
		<div class="dd" id="videoplaylist">
			<ol class="dd-list">
				<?php
				//	dd($videos);
				 ?>
				{{-- <div class="dd-placeholder" style="height: 42px;"></div> --}}
				@foreach($videos as $video)

				<li class="dd-item" data-id="{{ $video->id }}">
						<span class="pull-left"><div class="dd-handle"><i class="fa fa-bars"></i></div></span>
						{{-- <span class="pull-right"><a data-event="" id="" class="event-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></span> --}}
						<img src="/video/thumbs/{{ $video->thumbnail }}" height="30" width="30" /><span class="client-link" style="margin:0px 10px;">{{ $video->title }}</span>
						<a data-video-id="{{$video->video_id}}" id="file{{$video->video_id}}" class="remove-video btn btn-danger btn-sm pull-right" style="margin: 0px 10px;"><i class="fa fa-trash"></i></a>
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
{{--
@if(isset($videos) && count($videos)>0)
<table class="table table-hover playlist-videos-table  ">
	<thead>
		<tr>
			<th>Title</th>
			<th></th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

        @foreach($videos as $video)

        <tr class="playlist-videos">
            <td data-video-id="{{$video->id}}" > {{$video->title}} </td>
            <td></td>
            <td> <a data-video-id="{{$video->id}}" id="file{{$video->id}}" class="remove-video btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
        </tr>

        @endforeach
	</tbody>

</table>
@else
<table class="table table-hover playlist-videos-table hidden">
	<thead>
		<tr>
			<th>Title</th>
			<th></th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
@endif --}}
