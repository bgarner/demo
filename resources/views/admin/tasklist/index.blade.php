<!DOCTYPE html>
<html>

<head>
    @section('title', 'Task Lists')
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
	                        <h5>All Task Lists</h5>

	                        <div class="ibox-tools">

	                            <a href="/admin/tasklist/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> New Task List</a>
	                        </div>
	                    </div>
	                    <div class="ibox-content">



	                        <div class="table-responsive">

								<table class="table table-hover issue-tracker">

								<tr>
									<td>Title</td>
									<td>Description</td>
									<td>Due Date</td>
									<td>Action</td>
								</tr>

								@foreach($tasklists as $tasklist)
								<tr>

									<td><a href="/admin/tasklist/{{ $tasklist->id }}/edit">{{ $tasklist->title }}</a></td>
									<td>{!! $tasklist->description !!}</td>
									<td>{{ $tasklist->prettyDueDate }}</td>

									<td>

										<a data-tasklist="{{ $tasklist->id }}" id="tasklist{{ $tasklist->id }}" class="delete-tasklist btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

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

		@include('admin.includes.footer')

	    @include('admin.includes.scripts')

		<script type="text/javascript">
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

		</script>
		<script type="text/javascript" src="/js/plugins/ckeditor-custom/ckeditor.js"></script>
		<script type="text/javascript" src="/js/custom/admin/tasklist/deleteTasklist.js"></script>


		@include('site.includes.bugreport')

	</body>
</html>
