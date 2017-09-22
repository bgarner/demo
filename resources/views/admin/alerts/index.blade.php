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

										<table class="table table-hover issue-tracker tablesorter datatable">
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
													<button type="button" class="btn btn-primary btn-outline" data-container="body" data-toggle="popover" data-placement="top" data-content="{{$alert->target_stores}}" data-original-title="" title="" aria-describedby="popover199167">
						                                {{$alert->count_target_stores}} Stores
						                            </button>

												@elseif(isset($alert->all_stores) && $alert->all_stores)
													<button type="button" class="btn btn-primary btn-outline">All Stores</button>
												@else
													&mdash;
												@endif
											</td>


											<td data-order ="{{$alert->start}}" >{{ $alert->prettyStart }}</td>
											<td data-order ="{{$alert->end}}">{{ $alert->prettyEnd }}</td>
											<td >
												{{$alert->active}}

											</td>

											<td>
												<a href="/admin/document/{{ $alert->document_id }}/edit" class="btn btn-primary btn-sm btn-outline"><i class="fa fa-pencil"></i></a>
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

					$(".datatable").dataTable({
			    			"order": [[ 0, 'desc' ]],

							"columns": [
							    { "visible": false },
							    { "width": "45%" },
							    null,
							    null,
							    null,
							    null,
							    { "width" : "10%" , "sortable" : false}
							  ],
							pageLength: 50,
							responsive: true,
							fixedHeader: true

					});

				</script>
				@include('site.includes.modal')
				@include('site.includes.bugreport')


			</body>
			</html>
