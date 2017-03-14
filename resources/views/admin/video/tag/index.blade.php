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

		                                <a href="/admin/tag/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> Create New Tag</a>
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
												<td class="tag_name">{{$tag->name}}</td>
												<td>
													<a href="/admin/tag/{{$tag->id}}/edit" class="edit-tag btn btn-primary" id="{{$tag->id}}"><i class="fa fa-pencil"></i></a>
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

				@include('site.includes.footer')

			    @include('admin.includes.scripts')

				<script type="text/javascript">
					$.ajaxSetup({
				        headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        }
					});

				</script>

				<script type="text/javascript" src="/js/custom/admin/videos/tags/deleteTag.js"></script>

				@include('site.includes.bugreport')



			</body>
			</html>
