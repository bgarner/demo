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
		                            <h5>Edit Admin: {{ $user->firstname }} {{ $user->lastname}} </h5>
                                    <div class="ibox-tools">

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
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">FGL Username</label>
                                            <div class="col-sm-10">
                                                <input name="username" value="{{$user->username}}" readonly class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Job Title</label>
                                            <div class="col-sm-10">
                                                <input name="jobtitle" value="{{$user->fglposition}}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group"><label class="col-sm-2 control-label">Group</label>
                                            <div class="col-sm-10">
                                                {!! Form::select('group', $groups , $user->group_id, ['class'=>'form-control', 'id'=>'select-group', 'disabled']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Role</label>
                                            <div class="col-sm-10">
                                                {!! Form::select('role', $roles , $selected_role, ['class'=>'form-control', 'id'=>'select-role']) !!}
                                            </div>
                                        </div>

                                        @if(isset($selected_resource))
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Resource</label>
                                            <div class="col-sm-10">
                                                {!! Form::select('resource', $resources , $selected_resource, ['class'=>'form-control', 'id'=>'select-resource']) !!}


                                            </div>
                                        </div>
                                        @endif

                                        @if(isset($selected_bu) )
                                            @if(count($selected_bu) > 1)
                                            <div class="form-group hidden">
                                            @else
                                            <div class="form-group">
                                            @endif
                                                <label class="col-sm-2 control-label">Business Unit</label>
                                                <div class="col-sm-10">
                                                    {!! Form::select('businessUnit', $businessUnits , $selected_bu, ['class'=>'form-control', 'id'=>'select-bu']) !!}


                                                </div>
                                            </div>
                                        @endif

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


				<script src="/js/custom/superadmin/user/editUser.js"></script>

				@include('site.includes.bugreport')




			</body>
			</html>
