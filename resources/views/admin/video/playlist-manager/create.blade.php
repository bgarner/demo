<!DOCTYPE html>
<html>

<head>
    @section('title', 'Create New Playlist')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
    <link rel="stylesheet" href="/css/plugins/select/select2.min.css">
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<style>
        .modal-body{
            top: 120px;
            height: 90% !important;
        }
    </style>
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('admin.includes.sidenav')
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg" >

		<div class="wrapper wrapper-content  animated fadeInRight">
		            <div class="row">
		                <div class="col-lg-12">
		                    <div class="ibox">
		                        <div class="ibox-title">
		                            <h5>Create a New Playlist</h5>

		                            <div class="ibox-tools">

		                                <!-- <a href="/admin/communication/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Create New Communication</a> -->
		                            </div>
		                        </div>
		                        <div class="ibox-content">



									<form class="form-horizontal" id="createNewPlaylistForm">


										{{-- <input type="hidden" name="banner_id" value={{$banner->id}} > --}}

										<div class="form-group">
											<label class="col-sm-2 control-label">Title</label>
								            <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value=""></div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label"> Description</label>
											<div class="col-sm-10">
												<textarea class="description" name="description" cols="50" rows="10" id="description"></textarea>
											</div>

										</div>

										@include('admin.includes.store-banner-selector', ['optGroupOptions'=> $optGroupOptions, 'optGroupSelections' => $optGroupSelections])


										<div class="form-group">
											<div class="col-sm-10 col-sm-offset-2">
												<div id="add-videos" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Add videos</div>

											</div>
										</div>
										<div class="form-group">
											<div id="videos-selected"></div>

										</div>

										<div id="tag-selector-container">
											@include('admin.video.tag.tag-partial')
										</div>

										<div class="form-group">
											<div class="col-sm-10 col-sm-offset-2">
												<a class="btn btn-white" href="/admin/playlist"><i class="fa fa-close"></i> Cancel</a>
												<button class="btn btn-primary playlist-create"><i class="fa fa-check"></i> Save</button>
								            </div>
								        </div>

									</form>




		                        </div> <!-- ibox-content closes -->

		                    </div><!-- ibox closes -->
		                </div>
		            </div>


		        </div><!-- wrapper closes -->




		<div id="video-listing" class="modal inmodal fade">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Select Videos</h4>
		            </div>
		            <div class="modal-body">
		            	<ul class="tree">
						@include('admin.video.playlist-manager.video-list-partial', ['videos'=>$videos])
						</ul>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                <button type="button" class="btn btn-primary" id="attach-selected-videos">Select Videos</button>
		            </div>
		        </div>
		    </div>
		</div>






		@include('admin.includes.footer')

	    @include('admin.includes.scripts')

		@include('site.includes.bugreport')

		<script type="text/javascript" src="/js/vendor/moment.js"></script>
		<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-standard/ckeditor.js"></script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
		<script type="text/javascript" src="/js/custom/admin/videos/playlists/addPlaylist.js"></script>
		<script type="text/javascript" src="/js/custom/tree.js"></script>
		<script type="text/javascript" src="/js/custom/admin/global/storeAndBannerSelector.js"></script>
		<script type="text/javascript" src="/js/plugins/select/select2.min.js"></script>


		<script type="text/javascript">

			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

			CKEDITOR.replace('description', {

    		    filebrowserUploadUrl: "{{route('utilities.ckeditorimages.store',['_token' => csrf_token() ])}}"

    		});


			$(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});

		    $("#add-videos").click(function(){
		    	$("#video-listing").modal('show');
		    });

		   	initializeTagSelector();


		</script>

	</body>
	</html>
