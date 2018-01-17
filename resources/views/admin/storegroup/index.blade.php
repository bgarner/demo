<!DOCTYPE html>
<html>

<head>
    @section('title', 'Manage Groups')
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
		                            <h5>Store Groups</h5>

		                            <div class="ibox-tools">
										 <a href="/admin/storegroup/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Group</a>
		                                
		                            </div>
		                        </div>
		                        <div class="ibox-content">



		                            <div class="table-responsive">

										<table class="table table-hover issue-tracker tablesorter datatable">
											<thead>
												<tr>
													<td>Group Name</td>
													<td>Stores</td>
													<td class="actions">Action</td>
												</tr>
											</thead>
											<tbody>
										@foreach($storegroups as $storegroup)

										<tr>

											<td class="col-xs-2"><a href="/admin/storegroup/{{ $storegroup->id }}/edit">{{ $storegroup->group_name }}</a></td>
											<td class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
												{{-- @foreach($storegroup->components as $component)
													<span class="label">{!! $component->component_name !!}</span>
												@endforeach --}}
												@foreach($storegroup->stores as $store)
													<span class="label"> {!! $store !!} </span>
												@endforeach		 
										

											</td>
											
											<td class="col-xs-2">
												

												<a data-groupId="{{ $storegroup->id }}" id="group{{ $storegroup->id }}" class="group-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

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

				

				<script type="text/javascript" src="/js/custom/admin/storegroup/deleteStoreGroup.js"></script>
				<script type="text/javascript" src="/js/vendor/tablesorter.min.js"></script>
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
				@include('site.includes.bugreport')


			</body>
			</html>
