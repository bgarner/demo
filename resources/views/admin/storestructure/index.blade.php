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
			margin: 10px;
		}
		
		/*#store-listing{
			flex: 3 1 100px;
		}*/
		#district-listing{
			flex: 2 2 100px;
		}
		#region-listing{
			flex: 1 3 100px;
		}

		.listing-header{
			width:100%;
			color: #fff;
			text-align: center;
			padding: 10px;

		}
		
		.listing-body {
		    display: flex; /*parent prop for inner elements;*/
		   	flex-wrap: wrap; /*parent prop for inner elements;*/
		   	margin: 10px;
		}

		
		.card{
			width:270px;
			border: thin solid #4c4646;
			margin: 10px;
		}
		.card-header{
			background-color: orange;
			text-align: center;
			color:#4c4646;
		}
		.card-item{
			flex-basis: 270px;
			background-color: #e9e9e9;
			padding: 10px;
			margin: 10px;
		}

		.card-footer{
			background-color: yellow;
			text-align: center;
			padding: 10px;
		}
		
		/*#show-store-listing, #hide-store-listing{
			
			height: 35px;
			width: 40px;
			margin-right: 10px;

		}
		#show-store-listing{
			display: none;	
		}*/
		ol, li{
			list-style: none;
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
							
							{{--<div class="listing" id="store-listing">
							  	<div class="listing-header bg-primary">
							  		<h2>Stores</h2>

							  		<div id="hide-store-listing" class=" btn btn-primary">
							  			<i class="fa fa-bars"></i>
									</div>
							  	</div>
							  	<div class="listing-body">
									@foreach($stores as $store)
									<div class="card-item draggable">{{$store}}</div>
									@endforeach
								</div>
							</div>
							<div id="show-store-listing" class=" btn btn-primary">
							  	<i class="fa fa-bars"></i>
							</div> --}}
							<div class="listing" id="district-listing">
							  	<div class="listing-header bg-primary">
							  		<h2>Districts</h2>
							  	</div>
							  	<div class="listing-body">
							  		@foreach($districts as $district)
									<div class="card " >
										<div class="card-header">
											<div>
												{{$district->dm_details->firstname}} {{$district->dm_details->lastname}} 
											</div>
											<div>
												{{$district->name}}
											</div>
										</div>
										<ol class="sortable_list_district connectedSortable-district" id="sortable-district-{{$district->id}}" data-district-id="{{$district->id}}">
										@foreach($district->stores as $store)
											<li class="card-item ui-state-default" id="store-{{$store->store_number}}" data-store-id="{{$store->store_number}}">
											{{$banners[$store->banner_id]}} #{{$store->store_id}} - {{$store->name}}
											</li>
										@endforeach
										</ol>

										<div class="card-footer">
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
									<div class="card">
										<div class="card-header">
											<div>
												{{$region->avp_details->firstname}} {{$region->avp_details->lastname}} 
											</div>
											<div>
												{{$region->name}}
											</div>
										</div>
										<ol class="sortable_list_region connectedSortable-region" id="sortable-region-{{$region->id}}" data-region-id="{{$region->id}}">
										@foreach($region->districts as $district)
											<li class="card-item ui-state-default" id="district-{{$district->id}}" data-district-id="{{$district->id}}">
											{{$district->name}}
											</li>
										@endforeach
										</ol>
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
	<script src="/js/plugins/nestable/jquery.nestable.js"></script>
	<script type="text/javascript">
		
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});

		$(document).ready(function(){
			
			$( ".sortable_list_district" ).sortable({
			    connectWith: ".connectedSortable-district",
			    containment : $("#district-listing"),
			    receive: function(event, ui) {
			    	
			        var target_district_id = $(this).data('district-id');
			        var store_id = $(ui.item[0]).data('store-id');
			        $.ajax({
					    url: '/admin/districtstore/' + store_id ,
					    type: 'PATCH',
					    dataType: 'json',
					    data: {
					    	district_id: target_district_id
					    },

					    success: function(result) {
					      
					      	console.log(result);
					      	//update the view

					    }
					});   
			    }         
			}).disableSelection();
			$( ".sortable_list_region" ).sortable({
			    connectWith: ".connectedSortable-region",
			    containment : $("#region-listing"),
			    receive: function(event, ui) {
			        var target_region_id = $(this).data('region-id');
			        var district_id = $(ui.item[0]).data('district-id');
			        $.ajax({
					    url: '/admin/regiondistrict/' + district_id ,
					    type: 'PATCH',
					    dataType: 'json',
					    data: {
					    	region_id: target_region_id
					    },

					    success: function(result) {
					      
					      	console.log(result);
					      	//update the view

					    }
					});   
			    }         
			}).disableSelection();
		})



	</script>
	@include('site.includes.bugreport')


</body>
</html>
