<!DOCTYPE html>
<html>

<head>
    @section('title', 'Communications')
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
	                        <h5>All Communications</h5>

	                        <div class="ibox-tools">

	                            <a href="/admin/communication/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> New Communication</a>
	                        </div>
	                    </div>
	                    <div class="ibox-content">

	                        <div class="table-responsive">

								<table class="table datatable">
									<thead>
										<tr>
											<td>Id</td>
											<td>Subject</td>
											<td>Type</td>
											<td>Start</td>
											<td>Action</td>
										</tr>
									</thead>
									<tbody>
									@foreach($communications as $communication)
									<tr>
										<td>{{ $communication->id }}</td>
										<td><a href="/admin/communication/{{ $communication->id }}/edit" >{{ $communication->subject }}</a></td>
										<td><span class="label label-sm label-{{$communication->label_colour}}">{{$communication->label_name}}</span></td>
										<td data-order="{{$communication->send_at}}">{{ $communication->prettySentAtDate }}</td>

										<td>
											{{-- <a href="/admin/communication/{{ $communication->id }}/edit" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a> --}}
											<a  data-communicationid="{{ $communication->id }}"
												data-communicationname="{{ $communication->subject }}"
												id="copy-communication"
												class="btn btn-primary btn-outline btn-sm">
												<i class="fa fa-clipboard"></i>
											</a>
											<a data-communication="{{ $communication->id }}" id="communication{{ $communication->id }}" class="delete-communication btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>


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

        $(".datatable").dataTable(
        	{
    			"order": [[ 0, 'desc' ]],

				"columns": [
				    { "visible": false },
				    { "width": "45%" },
				    null,
				    null,
				    { "width" : "10%" , "sortable" : false}
				  ],
				pageLength: 50,
				responsive: true,
				fixedHeader: true
			}
		);



	</script>

	<script type="text/javascript" src="/js/custom/admin/communications/deleteCommunication.js"></script>
	<script type="text/javascript" src="/js/custom/admin/communications/copyCommunication.js"></script>


	@include('site.includes.bugreport')



</body>
</html>
