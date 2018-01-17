<!DOCTYPE html>
<html>

<head>
    @section('title', 'Product Launch')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<link rel="stylesheet" href="/css/plugins/dataTables/datatables.min.css">
	<!-- <link rel="stylesheet" href="/css/plugins/dataTables/dataTables.tableTools.min.css"> -->
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
                            <h5>All Product Launches</h5>

                            <div class="ibox-tools">

                                <a href="/admin/productlaunch/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> New Product Launch</a>
                            </div>
                        </div>
                        <div class="ibox-content">


	                    	<table class="table dataTable" id="productLaunchDataTable" >
	                    		<thead>
	                    			<tr role="row">
	                    				<th>Launch Date</th>
	                    				<th>Type</th>
	                    				<th>Style Number</th>
	                    				<th>Vendor Code</th>
	                    				<th>Dept</th>
	                    				<th>SubDept</th>
	                    				<th>Class</th>
	                    				<th>Style</th>
	                    				<th>Retail Price</th>
	                    				<th>Tracking</th>


	                    			</tr>
	                    		</thead>
	                    		<tbody>
	                    			@foreach($productLaunches as $productLaunch)
										<tr class="" role="row">
											<td>{{$productLaunch->launch_date}}</td>
											<td>{{$productLaunch->event_type}}</td>
											<td>{{$productLaunch->style_number}}</td>
											<td>{{$productLaunch->vendor_code}}</td>
											<td>{{$productLaunch->dpt_name}}</td>
											<td>{{$productLaunch->sdpt_name}}</td>
											<td>{{$productLaunch->cls_name}}</td>
											<td>{{$productLaunch->style_name}}</td>
											<td>{{$productLaunch->retail_price}}</td>
											<td>{{$productLaunch->tracking}}</td>
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

		<script type="text/javascript">
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

		</script>

		<script type="text/javascript" src="/js/plugins/dataTables/datatables.min.js"></script>
		<script>

	        $(document).ready(function(){
	            $('.dataTable').DataTable({
	                pageLength: 50,
	                responsive: true,
	                fixedHeader: true

	            });

			});


		</script>


		@include('site.includes.bugreport')



	</body>
	</html>
