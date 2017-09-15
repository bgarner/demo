<!DOCTYPE html>
<html>

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
                    <h2>Tags</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li class="active">
                            <strong>Tags</strong>
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
                            <h5>Tags</h5>

                            <div class="ibox-tools">

                                <a class="btn btn-primary btn" id="add-tag"><i class="fa fa-plus"></i> Create New Tag</a>
                            </div>
                        </div>
                        <div class="ibox-content">



                            <div class="table-responsive">
                            	<table class="table table-hover issue-tracker">
	                            	<tr>
										
										<th>Tag</th>
										<th>Actions</th>

									</tr>
	                            	@foreach($tags as $tag)
	                            	<tr id="tag-{{$tag->id}}">
										<td class="tag_name">
											<p id="{{$tag->id}}">{{$tag->name}}</p>
										</td>
										<td>
											
											<div class="delete-tag btn btn-danger" id="{{$tag->id}}"><i class="fa fa-trash"></i></div>
										</td>
									</tr>
	                            	@endforeach
                            	</table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <div id="add-tag-modal" class="modal inmodal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                	{!! Form::open(['action' => 'Video\TagAdminController@store']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Create New Tag</h4>
                    </div>
                    <div class="modal-body">
                    	
                    	<div class="form-group">
                        	<label class="control-label">Tag <span class="req">*</span></label>
                            <div ><input type="text" class="form-control" name="tag_name" id="tag" value=""></div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="create-tag">Add Tag</button>
                    </div>
                    {!! Form::close() !!}
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

		<script type="text/javascript" src="/js/custom/admin/videos/tags/tag.js"></script>
		<script type="text/javascript" src="/js/custom/site/launchModal.js" ></script>

		@include('site.includes.bugreport')



	</body>
	</html>
