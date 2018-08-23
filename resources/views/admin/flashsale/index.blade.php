<!DOCTYPE html>
<html>

<head>
    @section('title', 'Flash Sale')
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
	                            <h5>All Flash Sales</h5>

	                            <div class="ibox-tools">

	                                <a href="/admin/flashsale/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> New Flash Sale</a>
	                            </div>
	                        </div>
	                        <div class="ibox-content">

		                    	<table class="table dataTable" id="flashSaleDataTable" >
		                    		<thead>
		                    			<tr role="row">
		                    				<th>Style Number</th>
		                    				<th>Style Name</th>
		                    				<th>Department</th>
		                    				<th>Sub-Department</th>
		                    				<th>Class</th>
		                    				<th>Sub-Class</th>
		                    				<th>#Stores</th>
		                    			</tr>
		                    		</thead>
		                    		<tbody>
		                    			@foreach($flashSaleData as $flashSale)
											<tr role="row">
												<td>{{$flashSale->style_number}}</td>
			                    				<td>{{$flashSale->style_name}}</td>
			                    				<td>{{$flashSale->department}}</td>
			                    				<td>{{$flashSale->subdepartment}}</td>
			                    				<td>{{$flashSale->class}}</td>
			                    				<td>{{$flashSale->subclass}}</td>
			                    				<td>{{$flashSale->total_stores}}</td>
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
            });

		});


	</script>


	@include('site.includes.bugreport')



</body>
</html>
