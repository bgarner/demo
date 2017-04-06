<!DOCTYPE html>
<html>

<head>
    @section('title', 'Flyer')
    @include('site.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<link rel="stylesheet" href="/css/plugins/dataTables/datatables.min.css">
    <link rel="stylesheet" href="css/plugins/blueimp/css/blueimp-gallery.min.css">
	{{-- <link rel="stylesheet" href="/css/plugins/dataTables/dataTables.tableTools.min.css"> --}}
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

                <small class="pull-right"> Last Updated :  </small>
            </div>
        </div>


		<div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">

                        <div class="ibox-content">

	                    	<table class="table dataTable" id="productLaunchDataTable">
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
											<td><a href="flyer/{{ $flyer->id }}" title="View Flyer">{{ $flyer->flyer_name }}</a></td>
											<td>{{ $flyer->start_date }}</td>
											<td>{{ $flyer->end_date }}</td>
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
	        	console.log("ready");
	            $('.dataTable').DataTable({
	                pageLength: 50,
	                responsive: true,
	                fixedHeader: true

	            });

			});


            document.getElementById('links').onclick = function (event) {
                event = event || window.event;
                var target = event.target || event.srcElement,
                    link = target.src ? target.parentNode : target,
                    options = {index: link, event: event},
                    links = this.getElementsByTagName('a');
                    blueimp.Gallery(
                        document.getElementById('links').getElementsByTagName('a'),
                        {
                            container: '#blueimp-gallery-carousel',
                            carousel: true
                        }
                    );
            };




		</script>


		@include('site.includes.modal')


	</body>
	</html>
