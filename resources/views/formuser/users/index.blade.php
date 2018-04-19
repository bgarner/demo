<!DOCTYPE html>
<html>

<head>
    @section('title', 'Manage Users')
    @include('admin.includes.head')

	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation adminview">
    <div id="wrapper">
	    <nav class="navbar-default navbar-static-side" role="navigation">
	        <div class="sidebar-collapse">
	          @include('formuser.includes.sidenav')
	        </div>
	    </nav>

		<div id="page-wrapper" class="gray-bg" >

			<div class="wrapper wrapper-content  animated fadeInRight">
	            <div class="row">
	                <div class="col-lg-12">
	                    <div class="ibox">
	                        <div class="ibox-title">
	                            <h5>Users</h5>

	                            <div class="ibox-tools">
									<a href="/form/user/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New User</a>

	                            </div>
	                        </div>
	                        <div class="ibox-content">

	                            <div class="table-responsive">

									<table class="table table-hover issue-tracker tablesorter">
										<thead>
											<tr>
												<td>User</td>
												<td>Role</td>
												<td class="actions">Action</td>
											</tr>
										</thead>
										<tbody>
									@foreach($users as $user)

									<tr >
										<td class="col-xs-2">{{ $user->firstname }} {{ $user->lastname }}</td>
										<td class="col-xs-2">{{ $user->role_name }}</td>
										<td class="col-xs-2">
											@if(!$user->disabled) 
											<a href="/form/user/{{ $user->id }}/edit" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

											<a data-groupId="{{ $user->id }}" id="user{{ $user->id }}" class="user-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

											@endif

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
	    </div>
	</div>

	@include('admin.includes.footer')

    @include('admin.includes.scripts')



	<script type="text/javascript" src="/js/custom/forms/groups/deleteGroup.js"></script>
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
