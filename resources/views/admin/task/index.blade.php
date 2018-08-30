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
									<thead>
										<tr>
											<td></td>
											<td>Title</td>
											<td>Description</td>
											<td>Created By</td>
											<td>Due Date</td>
											<td>Action</td>
										</tr>
									</thead>
									<tbody>
									@foreach($tasks as $task)
									<tr>
										<td>{{$task->id}}</td>
										<td><a href="/admin/task/{{ $task->id }}/edit">{{ $task->title }}</a></td>
										<td>{!! $task->description !!}</td>
										<td>{{ $task->creator }}</td>
										<td data-order="{{$task->due_date}}">{{ $task->prettyDueDate }}</td>

										<td>

											<a data-task="{{ $task->id }}" id="task{{ $task->id }}" class="delete-task btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

										</td>
									</tr>
									@endforeach
									</tbody>
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

			$(".table").DataTable({
				"order": [[ 0, 'desc' ]],

				"columns": [
				    { "visible": false },
				    { "width": "30%" },
				    { "width": "45%" },
				    { "width": "10%" },
				    { "width": "10%" },
				    { "width": "5%" , "sortable" : false}
				  ],
				pageLength: 50,
				responsive: true,
				fixedHeader: true
			});

		</script>

		<script type="text/javascript" src="/js/custom/admin/tasks/deleteTask.js"></script>


		@include('site.includes.bugreport')

	</body>
</html>
