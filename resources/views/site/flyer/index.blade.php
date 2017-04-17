<!DOCTYPE html>
<html>

<head>
    @section('title', 'Flyer')
    @include('site.includes.head')

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

		<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>Flyers</h2>
            </div>
        </div>


		<div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">

                        <div class="ibox-content">

	                    	<table class="table">
	                    		<thead>
	                    			<tr role="row">
	                    				<th>Flyer Name</th>
	                    				<th>Start Date</th>
	                    				<th>End Date</th>
	                    			</tr>
	                    		</thead>
	                    		<tbody>
	                    			@foreach($flyers as $flyer)
										<tr class="flyer" role="row" data-flyer-id="{{$flyer->id}}">
											<td><a class="trackclick" href="flyer/{{ $flyer->id }}" data-flyer-id="{{ $flyer->id }}" title="View Flyer">{{ $flyer->flyer_name }}</a></td>
											<td>{{ $flyer->pretty_start_date }}</td>
											<td>{{ $flyer->pretty_end_date }}</td>
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

		@include('site.includes.modal')


	</body>
	</html>
