<!DOCTYPE html>
<html>

<head>
    @section('title', 'Packages')
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
                <h2>Packages</h2>
            </div>
        </div> --}}

		<div class="wrapper wrapper-content  animated fadeInRight">
		            <div class="row">
		                <div class="col-lg-12">
		                    <div class="ibox">
		                        <div class="ibox-title">
		                            <h5>Packages</h5>
		                            <div class="ibox-tools">
		                                <a href="/admin/package/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Package</a>
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

											<td>Actions</td>

										</tr>
										</thead>
										<tbody>
										@foreach($packages as $package)
										<tr>


											<td>{{$package->id}}</td>
											<td><a href="/admin/package/{{ $package->id }}/edit">{{ $package->package_name }}</a></td>
											<td>{{$package->package_screen_name}}</td>
											<td>

												<a data-package="{{ $package->id }}" id="package{{$package->id}}" class="package-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

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
						    { "width": "45%" },
						    { "width": "45%" },
						    { "width" : "10%" , "sortable" : false}
						  ],
						pageLength: 50,
						responsive: true,
						fixedHeader: true
					}
				);

				</script>

				<script src="/js/custom/admin/packages/deletePackage.js"></script>

				@include('site.includes.bugreport')



			</body>
			</html>
