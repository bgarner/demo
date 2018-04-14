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
	                            <h5>New User Group</h5>
	                            <div class="ibox-tools">

	                            </div>
	                        </div>
	                        <div class="ibox-content">

	                            <form method="get" class="form-horizontal">
	                                <div class="form-group"><label class="col-sm-2 control-label">Group Name</label>
	                                    <div class="col-sm-10"><input type="text" class="form-control" name="group_name" id="group_name" value=""></div>
	                                </div>

	                                <div class="form-group">
	                                	<label class="col-sm-2 control-label">Form</label>
	                                	<div class="col-sm-10">
	                                		{!! Form::select('form', $forms, null, [ 'class'=>'chosen', 'id'=> 'form']) !!}

	                                	</div>

	                                </div>
	                                <div class="form-group">
	                                	<label class="col-sm-2 control-label">Business Unit</label>
	                                	<div class="col-sm-10">
	                                		{!! Form::select('businessUnit', $businessUnits	, null, [ 'class'=>'chosen', 'id'=> 'businessUnit']) !!}

	                                	</div>

	                                </div>
	                                <div class="form-group">
	                                	<label class="col-sm-2 control-label">Users</label>
	                                	<div class="col-sm-10">
	                                		{!! Form::select('users[]', $formusers, null, [ 'class'=>'chosen', 'id'=> 'users', 'multiple'=>
	                                		'true']) !!}

	                                	</div>

	                                </div>

	                                <div class="hr-line-dashed"></div>

	                                <div class="form-group">
	                                    <div class="col-sm-4 col-sm-offset-2">
	                                        <a class="btn btn-white" href="/form/group"><i class="fa fa-close"></i> Cancel</a>
	                                        <button class="group-create btn btn-primary" ><i class="fa fa-check"></i> Create New User Group</button>

	                                    </div>
	                                </div>
	                            </form>


	                        </div>
	                    </div>

	                </div>
	            </div>


	        </div>

			@include('admin.includes.footer')

		    @include('admin.includes.scripts')
		</div>
	</div>


<!-- <script type="text/javascript" src="/js/custom/forms/groups/deleteGroup.js"></script> -->
	<script src="/js/custom/forms/groups/addGroup.js"></script>
	<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
	<script type="text/javascript">

		
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});

		$(".chosen").chosen({ width: '100%'});

	</script>
	@include('site.includes.bugreport')


</body>
</html>


		                    
		                
				
				
				