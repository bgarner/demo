<!DOCTYPE html>
<html>

<head>
    @section('title', 'Calendar')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
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
		                            <h5>Event Types</h5>

		                            <div class="ibox-tools">

		                                <a href="/admin/eventtypes/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Event Type</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">



		                            <div class="table-responsive">

										<table class="table table-hover issue-tracker datatable">
										<thead>
										<tr>
											<td>id</td>
											<td>Event Type</td>
											<!-- <td>Banners</td> -->
											<td></td>
										</tr>
										</thead>
										<tbody>
										@foreach($eventtypes as $et)
										<tr>


											<td>{{ $et->id }}</td>
											<td><a href="/admin/eventtypes/{{ $et->id }}/edit">{{ $et->event_type }}</a></td>
											{{-- <td>
												@foreach($et->banners as $banner)
													<span class="label">{{$banner->name}}</span>
												@endforeach
											</td> --}}


											<td>

												<a data-eventtype="{{ $et->id }}" id="eventtype{{$et->id}}" class="eventtype-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

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


		        </div>

				@include('admin.includes.footer')

			    @include('admin.includes.scripts')

				<script type="text/javascript">
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});

					$(".datatable").dataTable({

							"columns": [
							    { "visible": false },
							    null,
							    { "width" : "10%" , "sortable" : false}
							  ],
							pageLength: 50,
							responsive: true,
							fixedHeader: true

					});

				</script>

				<script src="/js/custom/admin/events/deleteEventType.js"></script>


				@include('site.includes.bugreport')



			</body>
			</html>
