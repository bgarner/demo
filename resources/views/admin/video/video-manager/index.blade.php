<!DOCTYPE html>
<html>

<head>
    @section('title', 'Videos')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<link rel="stylesheet" href="/css/plugins/dataTables/datatables.min.css">
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
		                            <h5>Videos</h5>

		                            <div class="ibox-tools">

		                                <a href="/admin/video/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Videos</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">

	                            	<table class="table datatable">
		                            	<thead>
		                            	<tr>
											<td></td>
											<td>Title</td>
											<td>Thumbnail</td>
											<td>Description</td>
											<!-- <td>Uploader</td> -->
											<td>Actions</td>
										</tr>
										</thead>
										<tbody>
		                            	@foreach($videos as $video)
		                            	<tr>
		                            		@if ($video->featured)
		                            			<td><i class="fa fa-film"></i> </td>
		                            		@else
		                            			<td></td>
		                            		@endif
		                            		<td>{!! $video->link !!}</a></td>
		                            		<td>
		                            			@if($video->thumbnail == 'video-placeholder.jpg')
												<img src="/images/{{$video->thumbnail}}" height="75" width="125">
		                            			@else
		                            			<img src="/video/thumbs/{{$video->thumbnail}}" height="75" width="125">
		                            			@endif
		                            		</td>
		                            		<td> {{$video->description}} </td>
		                            		{{--<td> {{$video->uploaderFirstName}} {{$video->uploaderLastName}} </td>--}}
		                            		<td>
		                            			<a href="/admin/video/{{$video->id}}/uploadthumbnail" class="btn btn-primary btn-sm btn-outline" title="Upload Video Thumbnail" data-videoId = "{{$video->id}}"><i class="fa fa-film"></i></a>
		                            			<a href="/admin/video/{{$video->id}}/edit" class=" btn btn-primary btn-sm btn-outline"><i class="fa fa-pencil"></i></a>
		                            			<a data-video="{{$video->id}}" id="video{{$video->id}}" class="video-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

		                            		</td>
		                            	</tr>
		                            	@endforeach
		                            	</tbody>
	                            	</table>
		                        </div>

		                    </div>
		                </div>
		            </div>


		        </div>

				@include('admin.includes.footer')

			    @include('admin.includes.scripts')




				<script type="text/javascript" src="/js/custom/admin/videos/deleteVideo.js"></script>
				<script type="text/javascript" src="/js/custom/admin/videos/createThumbnail.js"></script>
				<script type="text/javascript" src="/js/custom/site/launchModal.js" ></script>
				<script type="text/javascript" src="/js/plugins/dataTables/datatables.min.js"></script>

				<script type="text/javascript">
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});
					$(".datatable").DataTable({

	  	                pageLength: 10,
	 					responsive: true,
	 					fixedHeader: true

	  	            });

				</script>
				@include('site.includes.bugreport')
				@include('site.includes.modal')


			</body>
			</html>
