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
		<div class="row border-bottom">
			@include('admin.includes.topbar')
        </div>

		<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Communications</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li class="active">
                            <strong>Communications</strong>
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
		                            <h5>All Communications</h5>

		                            <div class="ibox-tools">

		                                <a href="/admin/communication/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> New Communication</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">



		                            <div class="table-responsive">

										<table class="table table-hover issue-tracker">

										<tr>
											<td>Subject</td>
											
											<td>Start</td>
											<td>Action</td>
										</tr>

										@foreach($communications as $communication)
										<tr>

											<!-- <td><a href="/admin/communication/{{ $communication->id }}/edit">{{ $communication->subject }}</a></td> -->
											<td>{{ $communication->subject }}</td>
											
											<td>{{ $communication->prettySentAtDate }}</td>
											
											<td>
												<a href="/admin/communication/{{ $communication->id }}/edit" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
												<a data-communication="{{ $communication->id }}" id="communication{{ $communication->id }}" class="delete-communication btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

											</td>
										</tr>
										@endforeach

										</table>

{{-- 										{!! $events->render() !!} --}}

		                            </div>
		                        </div>

		                    </div>
		                </div>
		            </div>


		        </div>

				@include('site.includes.footer')

			    @include('admin.includes.scripts')

				<script type="text/javascript">
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});

				</script>

				<script type="text/javascript" src="/js/custom/admin/communications/deleteCommunication.js"></script>
				

				@include('site.includes.bugreport')



			</body>
			</html>
