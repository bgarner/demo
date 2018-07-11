<!DOCTYPE html>
<html>

<head>
    @section('title', 'Manage Store Structure')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<style>
		
		.storestructure-container{
		   	display: flex;
		   	flex-wrap: nowrap;
		    border: thin solid red;
		    justify-content: center;
		    height:1000px;
		    
		}
		
		#store-listing{
			flex: 3 1 100px;
			overflow-y: scroll;
		}
		#district-listing{
			flex: 2 2 100px;
		}
		#region-listing{
			flex: 1 3 100px;
		}

		.listing-header{
			width:100%;
			border: thin solid grey;
			text-align: center;

		}
		
		.listing-body {
		    display: flex; /*parent prop for inner elements;*/
		   	flex-wrap: wrap; /*parent prop for inner elements;*/
		    margin: 10px;
		    border: thin solid lime;

		}						

		.store, .district, .region{
			padding: 10px;
			margin: 10px;
			border: thin solid blue;
			/*flex-basis: 100px;*/
		}

		.store{
			flex-basis: 270px;
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
                            <h5>Store Structure</h5>

                        </div>
                        <div class="ibox-content storestructure-container" >
							
							  <div class="listing" id="store-listing">
							  	<div class="listing-header">
							  		<h2>Stores</h2>
							  	</div>
							  	<div class="listing-body">
									@foreach($stores as $store)
									<div class="store">{{$store}}</div>
									@endforeach
								</div>
							  </div>
							  <div class="listing" id="district-listing">
							  	<div class="listing-header">
							  		<h2>Districts</h2>
							  	</div>
							  	<div class="listing-body">
							  		@foreach($districts as $district)
									<div class="district">
										<div>
											{{$district->dm_details->firstname}} {{$district->dm_details->lastname}} 
										</div>
										<div>
											{{$district->name}}
										</div>
									</div>
						  			@endforeach
						  		</div>
							  </div>
							  <div class="listing" id="region-listing">
							  	<div class="listing-header">
							  		<h2>Regions</h2>
							  	</div>
							  	<div class="listing-body">
							  		@foreach($regions as $region)
									<div class="region">
										<div>
											{{$region->avp_details->firstname}} {{$region->avp_details->lastname}} 
										</div>
										<div>
											{{$region->name}}
										</div>
									</div>
						  			@endforeach
							  	</div>
							  </div>
							  
							

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

	@include('admin.includes.footer')

    @include('admin.includes.scripts')

	

	<script type="text/javascript" src="/js/custom/admin/storegroup/deleteStoreGroup.js"></script>
	<script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
	<script type="text/javascript">
		
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});

	</script>
	@include('site.includes.bugreport')


</body>
</html>
