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
		<div class="row border-bottom">
			@include('admin.includes.topbar')
        </div>

		<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Calendar Events</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a>Calendar</a>
                        </li>
                        <li class="active">
                            <strong>Manage Events</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
		</div>

		<div class="wrapper wrapper-content  animated fadeInRight">
		            <div class="row">
		                <div class="col-lg-12">
		                    <div class="ibox">
		                        <div class="ibox-title">
		                            <h5>Event List</h5>
		                            <div class="ibox-tools">
		                                <a href="/admin/calendar/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Event</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">


		                            <div class="table-responsive">

										<table class="table datatable">
                                            <thead>
        										<tr>
        											<td>id</td>
        											<td>Title</td>
        											<td>Description</td>
                                                    <td>Event Type</td>
        											<td>Start</td>
        											<td>End</td>
        											<td></td>

        										</tr>
                                            </thead>

                                            <tbody>
    										@foreach($events as $event)
    										<tr>


    											<td>{{ $event->id }}</td>
    											<td><a href="/admin/calendar/{{ $event->id }}/edit">{{ $event->title }}</a></td>
    											<td>{{ mb_strimwidth($event->description, 0, 50, "...") }}</td>
                                                <td><span class="label label-sm" style="background-color: #{{$event->background_colour}}; color: #{{$event->foreground_colour}}; ">
                                                        {{ $event->event_type }}</span> </td>
    											<td data-order="{{$event->start}}">{{ $event->prettyStartDate }}</td>
    											<td data-order="{{$event->end}}">{{ $event->prettyEndDate }}</td>

    											<td>

    												<a data-event="{{ $event->id }}" id="event{{$event->id}}" class="event-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

    											</td>
    										</tr>
    										@endforeach
                                            <tbody>
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

                    $(".datatable").DataTable({
                        pageLength: 50,
            			responsive: true,
            			fixedHeader: true,
                        "order": [[ 0, 'desc' ]],
                        "columns": [
                            { 'visible' : false },
                            { "width": "25%" },
                            null,
                            null,
                            null,
                            null,
                            { "orderable": false, "searchable": false }
                        ]
                    });

				</script>

				<script src="/js/custom/admin/events/deleteEvent.js"></script>

				@include('site.includes.bugreport')



			</body>
			</html>
