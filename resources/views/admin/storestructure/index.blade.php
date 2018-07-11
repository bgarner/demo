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
		    justify-content: center;
		    height:1000px;
		    
		}
		.listing{
			overflow-y: scroll;
			border: thin solid grey;
		}
		
		#store-listing{
			flex: 3 1 100px;
		}
		#district-listing{
			flex: 2 2 100px;
		}
		#region-listing{
			flex: 1 3 100px;
		}

		.listing-header{
			width:100%;
			/*background-color: #285bbd;*/
			color: #fff;
			text-align: center;
			padding: 10px;

		}
		
		.listing-body {
		    display: flex; /*parent prop for inner elements;*/
		   	flex-wrap: wrap; /*parent prop for inner elements;*/
		    margin: 10px;

		}						

		.store, .district, .region{
			padding: 10px;
			margin: 10px;
			/*border: thin solid blue;*/
		}

		.store{
			flex-basis: 270px;
			background-color: #e9e9e9;
		}
		.district{
			width:270px;
			border: thin solid #4c4646;
		}

		.district-header{
			background-color: orange;
			text-align: center;
			color:#4c4646;
		}

		.district-footer{
			background-color: yellow;
			text-align: center;
		}
		
		#show-store-listing{
			display: none;
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
							  	<div class="listing-header  bg-primary" id='store-listing-header'>
							  		<h2>Stores</h2>
							  	</div>
							  	<div class="listing-body">
									@foreach($stores as $store)
									<div class="store draggable">{{$store}}</div>
									@endforeach
								</div>
							  </div>
							  <div id="show-store-listing">
							  	<i class="fa fa-chevron-circle-right"></i>
							  </div>
							  <div class="listing" id="district-listing">
							  	<div class="listing-header bg-primary">
							  		<h2>Districts</h2>
							  	</div>
							  	<div class="listing-body">
							  		@foreach($districts as $district)
									<div class="district">
										<div class="district-header">
											<div>
												{{$district->dm_details->firstname}} {{$district->dm_details->lastname}} 
											</div>
											<div>
												{{$district->name}}
											</div>
										</div>
										
										@foreach($district->stores as $store)
											<div class="store">
											{{$store->store_id}} - {{$store->name}}
											</div>
										@endforeach

										<div class="district-footer">
											{{count($district->stores)}} Stores
										</div>
									</div>
						  			@endforeach
						  		</div>
							  </div>
							  <div class="listing" id="region-listing">
							  	<div class="listing-header bg-primary">
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

										@foreach($region->districts as $district)
											<div class="district">
											{{$district->name}}
											</div>
										@endforeach
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

		$("#store-listing-header").click(function () {
		    $("#store-listing").animate({width: 'toggle'});
		    $('#show-store-listing').animate({width:'toggle'});
		});
		$("#show-store-listing").click(function(){
			$(this).animate({width: 'toggle'});
		    $('#store-listing').animate({width:'toggle'});
		})

	</script>
	@include('site.includes.bugreport')


</body>
</html>
