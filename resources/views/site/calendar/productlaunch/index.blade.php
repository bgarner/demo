<!DOCTYPE html>
<html>

<head>
    @section('title', 'Product Launch')
    @include('site.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<link rel="stylesheet" href="/css/plugins/dataTables/datatables.min.css">
	<!-- <link rel="stylesheet" href="/css/plugins/dataTables/dataTables.tableTools.min.css"> -->
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('site.includes.sidenav')
	        </div>
	    </nav>

	<div id="page-wrapper" class="gray-bg" >
		<div class="row border-bottom">
			@include('site.includes.topbar')
        </div>

		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>Product Launches</h2>
                <small class="pull-right"> Last Updated : {{$lastUpdated}} </small>
            </div>
        </div>        


		<div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        
                        <div class="ibox-content">
							
			                    	
	                    	<table class="table dataTable" id="productLaunchDataTable" >
	                    		<thead>
	                    			<tr role="row">
	                    				<th>Launch Date</th>
	                    				<th>Event Type</th>
	                    				<th>Style Number</th>
	                    				<th>Vendor Code</th>
	                    				<th>Style</th>
	                    				<th>Retail Price</th>
	                    				<th>Tracking</th>
	                    				
	                    			</tr>
	                    		</thead>
	                    		<tbody>
	                    			@foreach($productLaunches as $productLaunch)
										<tr class="" role="row">
											<td>{{$productLaunch->prettyLaunchDate}}</td>
											<td>{{$productLaunch->event_type}}</td>
											<td>{{$productLaunch->style_number}}</td>
											<td>{{$productLaunch->vendor_code}}</td>
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

		@include('site.includes.footer')

	    @include('site.includes.scripts')

	
		<script type="text/javascript" src="/js/plugins/dataTables/datatables.min.js"></script>
		<script>
			
	        $(document).ready(function(){
	            $('.dataTable').DataTable({
	                pageLength: 10,
	                responsive: true,
	                fixedHeader: true

	            });

			});


		</script>
		

		@include('site.includes.bugreport')



	</body>
	</html>
