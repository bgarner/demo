<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Edit Role')
    @include('admin.includes.head')
	<link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
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
                    <h2>Edit a User Role</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/role">Role</a>
                        </li>
                        <li class="active">
                            <strong>Edit User Role</strong>
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
		                            <h5>Edit User Role</h5>
		                            <div class="ibox-tools">
                                        
		                            </div>
		                        </div>
		                        <div class="ibox-content">

                                    <form method="get" class="form-horizontal">
                                    	<input type="hidden" name="roleID" id="roleID" value="{{ $role->id }}">
                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Role Name</label>
                                        	<div class="col-sm-10">
                                        		<input type="text" class="form-control" name="role_name" id="role_name" value="{{ $role->role_name }}" />
                                        	</div>
                                        </div>
                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Associated with Group</label>
                                        	<div class="col-sm-10">

                                        		{!! Form::select('groups[]', $groups, $selected_groups, [ 'class'=>'chosen', 'id'=> 'groups', 'multiple'=>'false']) !!}
                                        	</div>

                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Accessible Components</label>
                                            <div class="col-sm-10">
                                                {!! Form::select('components[]', $components, $selected_components, [ 'class'=>'chosen', 'id'=> 'components', 'multiple'=>'true']) !!}
                                                
                                            </div>

                                        </div>

										
                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/role"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="role-edit btn btn-primary" type="submit"><i class="fa fa-check"></i> Save Role</button>

                                            </div>
                                        </div>
                                    </form>


                                </div>
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
				<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
				<script src="/js/custom/admin/roles/editRole.js"></script>
				

				@include('site.includes.bugreport')

			</body>
			</html>
