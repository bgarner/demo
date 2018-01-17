<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Edit Group')
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

		<div class="wrapper wrapper-content  animated fadeInRight">
		            <div class="row">
		                <div class="col-lg-12">
		                    <div class="ibox">
		                        <div class="ibox-title">
		                            <h5>Edit User Group</h5>
		                            <div class="ibox-tools">

		                            </div>
		                        </div>
		                        <div class="ibox-content">

                                    <form method="get" class="form-horizontal">
                                    	<input type="hidden" name="groupID" id="groupID" value="{{ $group->id }}">
                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Group Name</label>
                                        	<div class="col-sm-10">
                                        		<input type="text" class="form-control" name="group_name" id="group_name" value="{{ $group->name }}" />
                                        	</div>
                                        </div>
                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label"> Roles Associated </label>
                                        	<div class="col-sm-10">

                                        		{!! Form::select('roles[]', $roles, $selected_roles, [ 'class'=>'chosen', 'id'=> 'roles', 'multiple'=>'true']) !!}
                                        	</div>

                                        </div>


                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/group"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="group-edit btn btn-primary" type="submit"><i class="fa fa-check"></i> Save Group</button>

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
				<script src="/js/custom/admin/groups/editGroup.js"></script>


				@include('site.includes.bugreport')

			</body>
			</html>
