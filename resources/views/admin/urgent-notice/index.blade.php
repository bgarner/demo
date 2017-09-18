<!DOCTYPE html>
<html>

<head>
    @section('title', 'Urgent Notice')
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
		                            <h5>Urgent Notice List</h5>
		                            <div class="ibox-tools">
		                                <a href="/admin/urgentnotice/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Urgent Notice</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">


		                            <div class="table-responsive">

										<table class="table table-hover issue-tracker datatable">
										<thead>
										<tr>
											<td>id</td>
											<td>Title</td>

											<td></td>

										</tr>
										</thead>
										<tbody>
										@foreach($urgent_notices as $urgent_notice)
										<tr>


											<td>{{ $urgent_notice->id }}</td>
											<td><a href="/admin/urgentnotice/{{ $urgent_notice->id }}/edit">{{ $urgent_notice->title }}</a></td>

											<td>

												<a data-urgent-notice-id="{{ $urgent_notice->id }}" id="urgent_notice{{$urgent_notice->id}}" class="urgent-notice-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

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
			    			"order": [[ 0, 'desc' ]],

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

				<script src="/js/custom/admin/urgent-notices/deleteUrgentNotice.js"></script>

				@include('site.includes.bugreport')



			</body>
			</html>
