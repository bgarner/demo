<!DOCTYPE html>
<html lang="en">

<head>
    @section('title', 'Tags')
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
		<div class="row border-bottom">
			@include('admin.includes.topbar')
        </div>

		<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Edit Tag</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li>
                            <a href="/admin/tag">Tag</a>
                        </li>
                        <li class="active">
                            <strong>Edit Tag</strong>
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
		                            <h5>Edit Tag</h5>
		                        </div>
		                        <div class="ibox-content">
		                  
                                    {!! Form::model($tag, ['action' => ['Video\TagAdminController@update', 'id'=>$tag->id], 'method' => 'PATCH', 'class'=>'form-horizontal']) !!}
                                    	<input type="hidden" name="banner_id" id="banner_id" value="{{ $tag->banner_id }}">
                                        
                                        <div class="form-group"><label class="col-sm-2 control-label">Tag Name</label>
                                            <div class="col-sm-10"><input type="text" class="form-control" name="tag_name" id="tag_name" value="{{ $tag->name }}"></div>
                                        </div>


                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <a class="btn btn-white" href="/admin/tag"><i class="fa fa-close"></i> Cancel</a>
                                                <button class="edit-tag btn btn-primary" type="submit"><i class="fa fa-check"></i> Update Tag</button>

                                            </div>
                                        </div>
                                    {!! Form::close() !!}


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

				<script src="/js/custom/tags.js"></script>

				@include('site.includes.bugreport')

			</body>
			</html>
