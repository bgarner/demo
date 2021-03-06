<!DOCTYPE html>
<html>

<head>
    @section('title', 'Manage Roles')
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
		                            <h5>Roles</h5>

		                            <div class="ibox-tools">
										 <a href="/admin/role/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New Role</a>

		                            </div>
		                        </div>
		                        <div class="ibox-content">



		                            <div class="table-responsive">

										<table class="table table-hover issue-tracker tablesorter">
											<thead>
												<tr>
													<td>Roles</td>
													<td>Groups</td>
													<td>Components</td>
													<td class="actions">Action</td>
												</tr>
											</thead>
											<tbody>
										@foreach($roles as $role)

										<tr>

											<td class="col-xs-2"><a href="/admin/role/{{ $role->id }}/edit">{{ $role->role_name }}</a></td>
											<td class="col-xs-2">

												@foreach($role->groups as $group)
													<span class="label"> {!! $group->name !!} </span>
												@endforeach


											</td>
											<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
												@foreach($role->components as $component)
													<span class="label">{!! $component->component_name !!}</span>
												@endforeach
											</td>

											<td class="col-xs-2">


												<a data-roleId="{{ $role->id }}" id="role{{ $role->id }}" class="role-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

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



				<script type="text/javascript" src="/js/custom/admin/roles/deleteRole.js"></script>
				<script type="text/javascript">

					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});


				</script>
				@include('site.includes.bugreport')


			</body>
			</html>
