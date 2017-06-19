<!DOCTYPE html>
<html>

<head>
    @section('title', 'Tasks')
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
                    <h2>Tasks</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin">Home</a>
                        </li>
                        <li class="active">
                            <strong>Tasks</strong>
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
	                        <h5>All Tasks</h5>

	                        <div class="ibox-tools">

	                            <a href="/admin/task/create" class="btn btn-primary btn"><i class="fa fa-plus"></i> New Task</a>
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

								@foreach($tasks as $task)
								<tr>

									<td>{{ $task->title }}</td>
									<td>{{ $task->description }}</td>
									<td>{{ $task->prettyDueDate }}</td>
									
									<td>
										<a href="/admin/task/{{ $task->id }}/edit" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
										<a data-task="{{ $task->id }}" id="task{{ $task->id }}" class="delete-task btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

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

		<script type="text/javascript" src="/js/custom/admin/tasks/deleteTask.js"></script>
		

		@include('site.includes.bugreport')

	</body>
</html>
