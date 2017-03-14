<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'User')
    @include('admin.includes.head')
	<link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>

<body class="fixed-navigation">
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
                    <h2>Edit an Admin Info</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin/home">Home</a>
                        </li>
                        <li>
                            <a href="/admin/user">User</a>
                        </li>
                        <li class="active">
                            <strong>Edit an Admin</strong>
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
		                            <h5>Edit Admin: {{ $user->firstname }} {{ $user->lastname}} </h5>
                                    <div class="ibox-tools">
                                        <a href="/admin/user/create" class="btn btn-primary" role="button"><i class="fa fa-plus"></i> Add New Admin</a>
                                        
                                    </div>
		                        </div>
		                        <div class="ibox-content">

                                    <form method="get" class="form-horizontal" autocomplete="off">
                                        <input type="hidden" name="userId" id="userId" value="{{ $user->id }}">
                                         
                                        <div class="form-group"><label class="col-sm-2 control-label">Name</label>
                                            <div class="col-sm-10">
                                                <input name="firstname" value="{{$user->firstname}}" class="form-control">
                                                <input name="lastname" value="{{$user->lastname}}" class="form-control">
                                            </div>
                                        </div>

                                        {{-- <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                <input name="email" value="{{$user->email}}" class="form-control">
                                            </div>
                                        </div> --}}                                        

                                        

                                        <div class="form-group"><label class="col-sm-2 control-label">Group</label>
                                            <div class="col-sm-10">
                                                {!! Form::select('group', $groups , $user->group_id, ['class'=>'form-control', 'id'=>'select-group']) !!}
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>


                                        <div class="form-group">

                                                <label class="col-sm-2 control-label">Banners</label>

                                                <div class="col-sm-10">

                                                    {!! Form::select('banners[]', $banners_list, $selected_banners, ['class'=>'chosen', 'multiple'=>'true', 'id'=>'select-banner']) !!}  
                                                </div>
                                        </div>
                                        
                                    </form>


                                </div>
		                    </div> <!-- ibox closes -->
                            <div class="ibox">
                                <div class="ibox-title">
                                    <h5>Update Password</h5>
                                    
                                </div>
                                <div class="ibox-content">
                                    <form class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-2 control-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" value class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group"><label class="col-sm-2 control-label">Confirm New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="confirm_password" value class="form-control">
                                        </div>
                                    </div>                                        

                                    </form>
                                </div>
                                 
                            </div> <!-- ibox closes -->
                            <div class="ibox">
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a class="btn btn-white" href="/admin/user"><i class="fa fa-close"></i> Cancel</a>
                                        <button class="user-update btn btn-primary" type="submit"><i class="fa fa-check"></i> Save changes</button>

                                    </div>
                                </div>
                            </div>
		                </div>

                    </div>
            </div>
	</div>


		        </div>

				@include('site.includes.footer')

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


				<script src="/js/custom/superadmin/user/editUser.js"></script>

				@include('site.includes.bugreport')




			</body>
			</html>
