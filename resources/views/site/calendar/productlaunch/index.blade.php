<!DOCTYPE html>
<html>

<head>
    @section('title', 'Product Launch')
    @include('site.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<link rel="stylesheet" href="/css/plugins/dataTables/datatables.min.css">
	<style>
		tbody{font-size: 11px;}
		thead{font-size: 12px;}
	</style>
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

		<div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">



                        <div class="ibox-content">
                            <p class="pull-right"><a href="#" data-toggle="modal" data-target="#productLaunchModal"><i class="fa fa-question-circle" aria-hidden="true"></i> Footwear Release vs. Footwear Launch</a>
                                <br /><small>{{ __("Last Updated")}} : {{$lastUpdated}}</small>
                            </p>
                            <h2>{{ __("Product Launches") }}</h2>
                            <hr />
	                    	<table class="table dataTable" id="productLaunchDataTable">

	                    		<thead>
	                    			<tr role="row">
	                    				<th>{{__("Launch Date")}}</th>
	                    				<th>{{__("Event Type")}}</th>
	                    				<th>{{__("Style Number")}}</th>
	                    				<th>{{__("Vendor Code")}}</th>
	                    				<th>{{__("Style")}}</th>
	                    				<th>{{__("Retail Price")}}</th>
	                    				<th>{{__("Tracking")}}</th>
										<th>{{__("Changes")}}</th>

	                    			</tr>
	                    		</thead>
	                    		<tbody>
	                    			@foreach($productLaunches as $productLaunch)
										<tr class="" role="row">
											<td>{{$productLaunch->launch_date}}</td>
											<td>{{$productLaunch->event_type}}</td>
											<td>{{$productLaunch->style_number}}</td>
											<td>{{$productLaunch->vendor_code}}</td>
											<td>{{$productLaunch->style_name}}</td>
											<td>{{$productLaunch->retail_price}}</td>
											<td>{{$productLaunch->tracking}}</td>
											<td>{{$productLaunch->changes}}</td>


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
	                pageLength: 50,
	                responsive: true,
	                fixedHeader: true

	            });

			});


		</script>


		@include('site.includes.modal')

	 <div class="modal inmodal" id="productLaunchModal" tabindex="-1" role="event" aria-hidden="true" style="display: none;" >

	    <div class="modal-dialog">
	        <div class="modal-content animated bounceInRight">
	<!--                 <div class="modal-header clearfix">
	                    <h4 id="modalTitle" class="modal-title">What's New?</h4>
	                </div> -->
	                <div id="modalBody" class="modal-body event-modal-body" style="padding: 20px;">

<h4>What is the difference between Footwear Release and Footwear Launch?</h4>

<p><em>Footwear Launch</em> – A true launch product has a hard date for availability to the public and cannot be sold, displayed or even socialized (pictures) prior to that date. The vendor typically creates some hype around launch products with marketing and social media leading up to the date. It is the expectation that launch product is to be in all applicable stores for the launch date, even if the vendor has to expedite the product to stores at their own cost to hit the launch. <strong>We will send a communication to stores if this product is late or is not expected to arrive.</strong></p>


<p><em>Footwear Release</em> – Styles with a release date cannot be sold before that specific date. There is not typically the same type of hype created by the vendor around the release and <strong>stores are not guaranteed to have product in time for the release.</strong> If a store receives the product in advance, they cannot sell before release date. <strong>We will not send communications to stores if this product is late or is not expected to arrive.</strong></p>



	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-primary btn-sm btn-outline" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
	                </div>
	        </div>
	    </div>
	</div>

	</body>
	</html>
