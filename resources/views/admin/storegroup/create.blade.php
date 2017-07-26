<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Groups')
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
                    <h2>Create a Store Group</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/storegroup">Custom Store Groups</a>
                        </li>
                        <li class="active">
                            <strong>Create a Store Group</strong>
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
		                            <h5>New Group</h5>
		                            <div class="ibox-tools">
                                        
		                            </div>
		                        </div>
		                        <div class="ibox-content">

                                    <form method="get" class="form-horizontal">
                                        <div class="form-group"><label class="col-sm-2 control-label">Group Name</label>
                                            <div class="col-sm-10"><input type="text" class="form-control" name="group_name" id="group_name" value=""></div>
                                        </div>

                                        <div class="form-group">
                                        	<label class="col-sm-2 control-label">Stores</label>
                                        	<div class="col-sm-10">
                                        		{!! Form::select('stores[]', $storeList, null, [ 'class'=>'chosen', 'id'=> 'stores', 'multiple'=>'true']) !!}
                                        		
                                        	</div>

                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/storegroup"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="group-create btn btn-primary" type="submit"><i class="fa fa-check"></i> Create New Store Group</button>

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
				<script src="/js/custom/admin/storegroup/addStoreGroup.js"></script>
				
				

				@include('site.includes.bugreport')

			</body>
			</html>
