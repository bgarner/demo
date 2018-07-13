<!DOCTYPE html>
<html>

<head>
    @section('title', 'Regions')
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


		<div class="wrapper wrapper-content  animated fadeInRight">
		            <div class="row">
		                <div class="col-lg-12">
		                    <div class="ibox">
		                        <div class="ibox-title">
		                            <h5>Region</h5>
		                            <div class="ibox-tools">
		                                <a href="/admin/region/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Region</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">


		                            <div class="table-responsive">

										<table class="table datatable">
                                            <thead>
        										<tr>
        											
        											<td>Region</td>
                                                    <td>Manager</td>
                                                    <td></td>

        										</tr>
                                            </thead>

                                            <tbody>
    										@foreach($regions as $region)
    										<tr>


    											<td><a href="/admin/region/{{ $region->id }}/edit">{{ $region->name }}</a></td>
    											<td>{{ $region->avp_details->firstname }} {{ $region->avp_details->lastname }}</td>
                                                <td>
                                                    <a data-region="{{ $region->id }}" id="region{{$region->id}}" class="region-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                </td>
    											
                                               
    										</tr>
    										@endforeach
                                            <tbody>
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

                    $(".datatable").DataTable({
                        
                    });

				</script>

				<script src="/js/custom/admin/regions/deleteRegion.js"></script>

				@include('site.includes.bugreport')



			</body>
			</html>
