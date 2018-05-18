<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'User')
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
                            <h5>Add Admin </h5>
                            <div class="ibox-tools">
                                <a href="/admin/user/create" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add New Admin</a>

                            </div>
                        </div>
                        <div class="ibox-content">

                            <form method="get" class="form-horizontal" autocomplete="off">

                                <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input name="firstname" value class="form-control" placeholder="First Name">
                                        <input name="lastname" value class="form-control" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Job Title</label>
                                    <div class="col-sm-10">
                                        <input name="jobtitle" value="" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input name="email" value class="form-control">
                                    </div>
                                </div>



                                <div class="form-group"><label class="col-sm-2 control-label">Group</label>
                                    <div class="col-sm-10">
                                        {!! Form::select('group', $group_names , "", ['class'=>'form-control', 'id'=>'select-group']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Role</label>
                                    <div class="col-sm-10">
                                        <select name="role" id="select-role" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Resource</label>
                                    <div class="col-sm-10">
                                        <select name="resource" id="select-resource" class="form-control"></select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Business Unit</label>
                                    <div class="col-sm-10">
                                        
                                        {!! Form::select('businessUnit', $businessUnits , "", ['class'=>'form-control', 'id'=>'select-bu']) !!}
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" value class="form-control">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="confirm_password" value class="form-control">
                                    </div>

                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">

                                        <label class="col-sm-2 control-label">Banners</label>

                                        <div class="col-sm-10">

                                            {!! Form::select('banners[]', $banners_list, null, ['class'=>'chosen', 'multiple'=>'true', 'id'=>'select-banner']) !!}
                                        </div>
                                </div>

                                <div class="hr-line-dashed"></div>


                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a class="btn btn-white" href="/admin/user"><i class="fa fa-close"></i> Cancel</a>
                                        <button class="user-create btn btn-primary" type="submit"><i class="fa fa-check"></i> Save changes</button>

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

<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
<script type="text/javascript">
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
	});
    $(".chosen").chosen({
        width:'50%'
    });

</script>


<script src="/js/custom/superadmin/user/addUser.js"></script>

@include('site.includes.bugreport')




</body>
</html>
