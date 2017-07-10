<!DOCTYPE html>
<html>

<head>
    @section('title', 'Manage Alerts')
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
                    <h2>Manage Alerts</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a>Alerts</a>
                        </li>
                        <li class="active">
                            <strong>Manage Alerts</strong>
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
		                            <h5>Alerts</h5>

		                            <div class="ibox-tools">
		                                <a href="/admin/alert/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> New Alert</a>
		                            </div>
		                        </div>
		                        <div class="ibox-content">



		                            <div class="table-responsive">

										<table class="table table-hover issue-tracker tablesorter">
											<thead>
												<tr>
													<td>Type</td>
													<td>Title</td>
													<td>Stores</td>
													<td>Start</td>
													<td>End</td>
													<td>Visible</td>
													<td class="actions">Action</td>
												</tr>
											</thead>
											<tbody>
										@foreach($alerts as $alert)

										<tr>

											<td> {{$alert->alert_type}}</td>
											<td>
												{{-- <a href="#" class="launchPDFViewer" data-toggle="modal" data-file="/viewer/?file=/files/{{ $alert->filename }}" data-target="#fileviewmodal">{!!$alert->icon!!} {{ $alert->document_name }}</a> --}}

												{!! $alert->modalLink !!}
												
										
											<td>
												@if($alert->count_target_stores > 0)
													<button type="button" class="btn btn-primary" data-container="body" data-toggle="popover" data-placement="top" data-content="{{$alert->target_stores}}" data-original-title="" title="" aria-describedby="popover199167">
						                                {{$alert->count_target_stores}} Stores
						                            </button>
													
												@elseif(isset($alert->all_stores) && $alert->all_stores)
													<button type="button" class="btn btn-primary">All Stores</button>
												@else
													&mdash;
												@endif
											</td>
											

											<td data-start-date ="{{$alert->start}}" >{{ $alert->prettyStart }}</td>
											<td data-end-date ="{{$alert->end}}">{{ $alert->prettyEnd }}</td>
											<td >
												{{$alert->active}}

											</td>

											<td>
												<a href="/admin/document/{{ $alert->document_id }}/edit" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

												<a data-alert="{{ $alert->id }}" id="alert{{ $alert->id }}" class="delete-alert btn btn-danger btn-sm"><i class="fa fa-ban"></i></a>

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

				

				<script type="text/javascript" src="/js/custom/admin/alerts/deleteAlert.js"></script>
				<script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
				<script type="text/javascript" src="/js/custom/site/launchModal.js" ></script>
				<script type="text/javascript">
					
					$.tablesorter.addParser({
						// set a unique id
						id: 'portalDates',
						is: function(s) {
							// return false so this parser is not auto detected
							return false;
						},
						format: function(s,table, cell, cellIndex) {
							// format your data for normalization
							
							if (cellIndex === 3) {
								return $(cell).attr("data-start-date");
							}
							else if (cellIndex === 4) {
								return $(cell).attr("data-end-date");
							}
						},
						// set type, either numeric or text
						type: 'text'
					});


					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});

					
					
					$(function() {
						$("table").tablesorter({
							sortList: [[3,1]],
							headers: {
								3:{ sorter:'portalDates'},
								4:{ sorter:'portalDates'},
								'.actions' : { sorter:false},
							}
						});
					}); 

				</script>
				@include('site.includes.modal')
				@include('site.includes.bugreport')


			</body>
			</html>
