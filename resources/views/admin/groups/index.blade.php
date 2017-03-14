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
		<div class="row border-bottom">
			@include('admin.includes.topbar')
        </div>

		<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Manage User Groups</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a>Groups</a>
                        </li>
                        <li class="active">
                            <strong>Manage User Groups</strong>
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
		                            <h5>Groups</h5>

		                            <div class="ibox-tools">
										 <a href="/admin/group/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Group</a>
		                                
		                            </div>
		                        </div>
		                        <div class="ibox-content">



		                            <div class="table-responsive">

										<table class="table table-hover issue-tracker tablesorter">
											<thead>
												<tr>
													<td>Groups</td>
													<td>Roles</td>
													<td class="actions">Action</td>
												</tr>
											</thead>
											<tbody>
										@foreach($groups as $group)

										<tr>

											<td class="col-xs-2">{{ $group->name }}</td>
											<td class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
												{{-- @foreach($group->components as $component)
													<span class="label">{!! $component->component_name !!}</span>
												@endforeach --}}
												@foreach($group->roles as $role)
													<span class="label"> {!! $role->role_name !!} </span>
												@endforeach		 
										

											</td>
											
											<td class="col-xs-2">
												<a href="/admin/group/{{ $group->id }}/edit" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

												<a data-groupId="{{ $group->id }}" id="group{{ $group->id }}" class="group-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

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

				@include('site.includes.footer')

			    @include('admin.includes.scripts')

				

				<script type="text/javascript" src="/js/custom/admin/groups/deleteGroup.js"></script>
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
