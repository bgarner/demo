<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Roles')
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
		                            <h5>New Role</h5>
		                            <div class="ibox-tools">

		                            </div>
		                        </div>
		                        <div class="ibox-content">

                                    <form method="get" class="form-horizontal">
                                        <div class="form-group"><label class="col-sm-2 control-label">Role Name</label>
                                            <div class="col-sm-10"><input type="text" class="form-control" name="role_name" id="role_name" value=""></div>
                                        </div>

                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Associated with Groups</label>
                                        	<div class="col-sm-10">
                                        		{!! Form::select('group', $groups, null, [ 'class'=>'chosen', 'id'=> 'group']) !!}

                                        	</div>

                                        </div>

                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Accessible Components</label>
                                        	<div class="col-sm-10">
                                        		{!! Form::select('components[]', $components, null, [ 'class'=>'chosen', 'id'=> 'components', 'multiple'=>'true']) !!}

                                        	</div>

                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Manages Resource Type</label>
                                            <div class="col-sm-10">
                                                {!! Form::select('resource_type', $resourceTypes, null, [ 'class'=>'chosen', 'id'=> 'resource_type']) !!}

                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Accessible Forms</label>
                                            <div class="col-sm-10">
                                                {!! Form::select('forms[]', $forms, null, [ 'class'=>'chosen', 'id'=> 'forms', 'multiple'=>'true']) !!}

                                            </div>

                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/role"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="role-create btn btn-primary" type="submit"><i class="fa fa-check"></i> Create New User Role</button>

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

				@include('admin.includes.footer')

			    @include('admin.includes.scripts')

				<script type="text/javascript">
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});
				</script>
				<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
				<script src="/js/custom/admin/roles/addRole.js"></script>



				@include('site.includes.bugreport')

			</body>
			</html>
