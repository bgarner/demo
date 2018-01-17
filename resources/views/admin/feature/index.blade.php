<!DOCTYPE html>
<html>

<head>
    @section('title', 'Features')
    @include('admin.includes.head')

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
        {{-- <div class="row wrapper border-bottom white-bg">
            <div class="col-lg-12">
                <h2>Features</h2>
            </div>
        </div> --}}

		<div class="wrapper wrapper-content  animated fadeInRight">
		            <div class="row">
		                <div class="col-lg-12">
		                    <div class="ibox">
		                        <div class="ibox-title">
		                            <h5>Features</h5>

		                            <div class="ibox-tools">

		                                <a href="/admin/feature/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Create New Feature</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">



		                            <div class="table-responsive">
		                            	<table class="table table-hover issue-tracker datatable">
			                            	<thead>
			                            	<tr>
												<td>Id</td>
												<td>Title</td>
												<td>Label</td>
												<td>Thumb</td>
												<td>Cover</td>
												<td>Actions</td>
											</tr>
											</thead>
											<tbody>
			                            	@foreach($features as $feature)
			                            	<tr>
			                            		<td>{{$feature->id}}</td>
			                            		<td><a href="/admin/feature/{{$feature->id}}/edit">{{ $feature->title }}</a></td>
			                            		<td> {{$feature->tile_label}} </td>
			                            		<td><img src="/images/featured-covers/{{ $feature->thumbnail }}" height="75" width="75" /></td>
			                            		<td><img src="/images/featured-backgrounds/{{ $feature->background_image }}" height="75" width="125" /></td>
			                            		<td>
			                            			<a data-feature="{{$feature->id}}" id="feature{{$feature->id}}" class="feature-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

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


		        </div>

				@include('admin.includes.footer')

			    @include('admin.includes.scripts')

				<script type="text/javascript">
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});
					$(".datatable").dataTable(
		        	{
		        		"order": [[ 0, 'desc' ]],
						"columns": [
						    { "visible": false },
						    null,
						    null,
						    null,
						    null,
						    { "width" : "10%" , "sortable" : false}
						  ],
						pageLength: 50,
						responsive: true,
						fixedHeader: true
					});

				</script>

				<script type="text/javascript" src="/js/custom/admin/features/deleteFeature.js"></script>

				@include('site.includes.bugreport')



			</body>
			</html>
