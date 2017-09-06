<!DOCTYPE html>
<html>

<head>
    @section('title', 'Playlists')
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
		<div class="row border-bottom">
			@include('admin.includes.topbar')
        </div>

		<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Playlists</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li class="active">
                            <strong>Playlists</strong>
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
		                            <h5>Playlists</h5>

		                            <div class="ibox-tools">

		                                <a href="/admin/playlist/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Playlist</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">

	                            	<table class="table datatable">
		                            	<thead>
		                            	<tr>
											
											<td>Title</td>
											<td>Actions</td>
										</tr>
										</thead>
										<tbody>
		                            	@foreach($playlists as $playlist)
		                            	<tr>
		                            		
		                            		<td><a href="/admin/playlist/{{$playlist->id}}/edit">{!! $playlist->title !!}</a></td>
		                            		<td>
		                            			
		                            			<a data-playlist="{{$playlist->id}}" id="playlist{{$playlist->id}}" class="playlist-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

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

				

				<script type="text/javascript" src="/js/custom/admin/videos/playlists/deletePlaylist.js"></script>
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
