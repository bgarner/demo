<!DOCTYPE html>
<html>

<head>
    @section('title', 'Flyer')
    @include('site.includes.head')
    <link rel="stylesheet" media="screen" href="/js/plugins/lightbox2/css/lightbox.css" >
    <link rel="stylesheet" media="screen" href="/css/plugins/dataTables/datatables.min.css">
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>

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

		<div class="row wrapper border-bottom white-bg page-heading printable">
            <div class="col-lg-12">
                <h2>{{$flyer->flyer_name}} <i><small> {{$flyer->pretty_start_date}} to {{$flyer->pretty_end_date}} </small></i> </h2>
            </div>
        </div>


		<div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">

                        <div class="ibox-content">

	                    	<table class="table dataTable printable" id="productLaunchDataTable">
	                    		<thead>
	                    			<tr role="row">
	                    				<th>Category</th>
	                    				<th>Brand Name</th>
	                    				<th>Product Name</th>
	                    				<th>PMM</th>
	                    				<th>Disclaimer</th>
	                    				<th>Original Price</th>
	                    				<th>Sale Price</th>
	                    				<th>Notes</th>
	                    				<th>Images</th>
	                    			</tr>
	                    		</thead>
	                    		<tbody>
	                    			@foreach($flyerItems as $item)
										<tr class="" role="row">
											<td>{{ $item->category }}</td>
											<td>{{ $item->brand_name }}</td>
											<td>{{ $item->product_name }}</td>
											<td>
											@foreach($item->pmm_numbers as $pmm_numbers)
												{{ $pmm_numbers }}<br />
											@endforeach
											</td>
											<td>{{ $item->disclaimer }}</td>
											<td>{{ $item->original_price }}</td>
											<td>{{ $item->sale_price }}</td>
											<td>{{ $item->notes }}</td>
											<td id="links">
												@foreach($item->images as $key=>$image)
                                                    <a title="{{ $item->brand_name }} {{ $item->product_name }} <br /> Orig Price: ${{ $item->original_price }} Sale Price: ${{ $item->sale_price }} <br /> Style #: {{ $key }}" data-lightbox="product" href="{{ $image['full'] }}"><img src="{{ $image['thumb'] }}" style="border: 1px solid #eee; float: left;" /></a>
												@endforeach

											</td>
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
        <script type="text/javascript" src="/js/plugins/lightbox2/js/lightbox.min.js"></script>

		<script>

	        $(document).ready(function(){
	        	console.log("ready");
	            $('.dataTable').DataTable({
	                pageLength: 50,
	                responsive: true,
	                fixedHeader: true
	            });
			});
		</script>

		@include('site.includes.modal')

	</body>
	</html>
