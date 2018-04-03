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
	                            <h5>Users</h5>

	                            <div class="ibox-tools">
									<a href="/form/user/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Add New User</a>

	                            </div>
	                        </div>
	                        <div class="ibox-content">


								{{--
	                            <div class="table-responsive">

									<table class="table table-hover issue-tracker tablesorter">
										<thead>
											<tr>
												<td>Group</td>
												<td>Form</td>
												<td class="actions">Action</td>
											</tr>
										</thead>
										<tbody>
									@foreach($groups as $group)

									<tr>
										<td class="col-xs-2">{{ $group->group_name }}</td>
										<td class="col-xs-2">{{ $group->form_label }}</td>
										<td class="col-xs-2">
											<a href="/form/group/{{ $group->id }}/edit" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

											<a data-groupId="{{ $group->id }}" id="group{{ $group->id }}" class="group-delete btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

										</td>
									</tr>
									@endforeach
									</tbody>
									</table>

	                            </div> --}}
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
