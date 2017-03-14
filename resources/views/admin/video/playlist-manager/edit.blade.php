<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Playlist')
    @include('admin.includes.head')

    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('admin.includes.sidenav')
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg" >
		<div class="row border-bottom">
			@include('admin.includes.topbar')
        </div>

		<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Edit a Playlist</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/playlist">Playlist</a>
                        </li>
                        <li class="active">
                            <strong>Edit a Playlist</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
		</div>

		<div class="wrapper wrapper-content  animated fadeInRight">
		            <div class="row">
		                <div class="col-lg-12">
		                    <div class="ibox">
		                        <div class="ibox-title">
		                            <h5>Edit Playlist: {{ $playlist->title }}</h5>
		                            <div class="ibox-tools">
		                                <a href="/admin/playlist/create" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add New Playlist</a>

		                            </div>
		                        </div>
		                        <div class="ibox-content">

                                    <form  method="" class="form-horizontal"  enctype="multipart/form-data" >
                                        <input type="hidden" name="playlistID" id="playlistID" value="{{ $playlist->id }}">
                                        <input type="hidden" name="banner_id" value="{{$banner->id}}">

                                        <div class="form-group"><label class="col-sm-2 control-label"> Title</label>
                                            <div class="col-sm-10"><input type="text" id="playlist_title" name="playlist_title" class="form-control" value="{{ $playlist->title }}"></div>
                                        </div>

                                        <div class="form-group">
											<label class="col-sm-2 control-label">Body</label>
												<div class="col-sm-10">
													<textarea class="description" name="description" cols="50" rows="10" id="description">
														{{ $playlist->description }}

													</textarea>

												</div>
										</div>

                                    </form>

                                </div>
                            </div>

                            <div class="ibox">
                            	<div class="ibox-title">
                            		<h5> Videos </h5>
                            		<div class="ibox-tools">

                            			<div id="add-more-videos" class="btn btn-primary btn-outline col-md-offset-8" role="button" ><i class="fa fa-plus"></i> Add More Videos</div>
                            		</div>

                            	</div>
                            	<div class="ibox-content">
                                <div class="existing-videos row" >

									<!-- <div class="form-group"><label class="col-sm-2 control-label">videos Attached</label> -->
										<div class="existing-videos-container">
											@include('admin.video.playlist-manager.playlist-videos-partial', ['videos'=>$playlist_videos])

										</div>
									<!-- </div> -->
									<div id="videos-staged-to-remove"></div>

								</div>
								<div id="videos-selected" class="row"></div>
								</div>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-white" href="/admin/playlist"><i class="fa fa-close"></i> Cancel</a>
                                    <button class="playlist-update btn btn-primary" type="submit"><i class="fa fa-check"></i> Save changes</button>

                                </div>
                            </div>



                    </div>
                </div>
            </div>

				@include('site.includes.footer')

			    @include('admin.includes.scripts')
            </div>







	@include('site.includes.bugreport')


	<div id="video-listing" class="modal fade">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title">Select Videos</h4>
	            </div>
	            <div class="modal-body">
	            	<ul class="tree">
	            	@include('admin.video.playlist-manager.video-list-partial', ['videos'=> $videos ])
					</ul>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                <button type="button" data-dismiss="modal" class="btn btn-primary" id="attach-selected-videos">Select Videos</button>
	            </div>
	        </div>
	    </div>
	</div>

	<script type="text/javascript" src="/js/custom/admin/videos/playlists/editPlaylist.js"></script>
	<script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
    <script src="/js/plugins/nestable/jquery.nestable.js"></script>
    <script src="/js/custom/admin/videos/playlists/changeVideoOrder.js"></script>

	<script type="text/javascript">
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});
		CKEDITOR.replace('description', {
    		filebrowserUploadUrl: "{{route('utilities.ckeditorimages.store',['_token' => csrf_token() ])}}"
    	});
	</script>


    <script type="text/javascript">

    	 $(document).ready(function(){

    		var serializeVideoData = function (e) {
    			 var list = e.length ? e : $(e.target);
    			 var data = list.nestable('serialize');
    			 updateVideoOrder(data);
    		 };

    		 $('#videoplaylist').nestable({
    			 group: 1
    		 }).on('change', serializeVideoData);

    	 });
    </script>

</body>
</html>
