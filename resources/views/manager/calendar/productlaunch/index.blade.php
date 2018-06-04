<!DOCTYPE html>
<html>

<head>
    @section('title', 'Calendar')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('manager.includes.head')

    <style>
        .event-span{
    
            padding-bottom: 10px;
            font-size: 12px;
            font-weight: normal;
        }

        .event-modal-body{
            padding: 15px;
        }
    </style>

</head>

<body class="fixed-navigation">
	<div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('manager.includes.nav')
	        </div>
	    </nav>

	    <div id="page-wrapper" class="gray-bg">
	        <div class="row border-bottom">
	            @include('manager.includes.topbar')
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
										<th>{{__("Stores")}}</th>
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
											<td>
												@foreach($productLaunch->stores as $store)
													<span class="badge">{{$store}}</span>
												@endforeach
											</td>
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
		</div>
	</div>


    @include('manager.includes.footer')

    @include('manager.includes.scripts')

    <script type="text/javascript" src="/js/custom/manager/calendar/listViewUtils.js"></script>
    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
    <script type="text/javascript" src="/js/plugins/fullcalendar/fullcalendar.min.js"></script>
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
