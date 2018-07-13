<!DOCTYPE html>
<html>

<head>
    @section('title', 'Stores')
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
		                            <h5>Store</h5>
		                            <div class="ibox-tools">
		                                <a href="/admin/store/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Store</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">


		                            <div class="table-responsive">

										<table class="table datatable">
                                            <thead>
        										<tr>
        											
        											<td>District</td>
                                                    <td>Manager</td>
                                                    <td></td>

        										</tr>
                                            </thead>

                                            <tbody>
    										@foreach($districts as $district)
    										<tr>


    											
    											<td><a href="/admin/district/{{ $district->id }}/edit">{{ $district->name }}</a></td>
    											<td>{{ $district->dm_details->firstname }} {{ $district->dm_details->lastname }}</td>
                                                <td>
                                                    <a data-district="{{ $district->id }}" id="district{{$district->id}}" class="district-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

				<script src="/js/custom/admin/districts/deleteStore.js"></script>

				@include('site.includes.bugreport')



			</body>
			</html>
