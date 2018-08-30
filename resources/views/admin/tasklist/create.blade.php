<!DOCTYPE html>
<html>

<head>
    @section('title', 'Create New Tasklist')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<style>
	.stagedTask, .task_item{
      		margin : 10px 0 10px 0;
    }
	</style>
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
                            <h5>Create a New Task List</h5>

                            <div class="ibox-tools">

                            </div>
                        </div>
                        <div class="ibox-content">

							<form class="form-horizontal" id="createNewTaskForm">

								<div class="form-group">
									<label class="col-sm-2 control-label">Title <span class="req">*</span> </label>
						            <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value=""></div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Description</label>
										<div class="col-sm-10">
											<textarea class="description" name="description" cols="50" rows="10" id="description"></textarea>
										</div>
								</div>
								
							</form>



                        </div> <!-- ibox-content closes -->

                    </div><!-- ibox closes -->
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Tasks</h5>

                            <div class="ibox-tools">
                            	<div class="btn btn-primary btn-outline" type="button" role="button" id="add-tasks" >
                            		<i class="fa fa-plus"></i> Add Tasks
                            	</div>

                            </div>
                        </div>
                        <div class="ibox-content">

                            <div id="tasks-selected">
                            	<table class="table table-hover tasklist-tasks-table hidden ">
                            		<thead>
                            			<tr>
                            				<td>Title</td>
                            				<td></td>
                            				<td class="align-right">Action</td>
                            			</tr>
                            		</thead>
                            		<tbody>
                            		</tbody>
                            	</table>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<a class="btn btn-white" href="/admin/tasklist"><i class="fa fa-close"></i> Cancel</a>
							<button class="btn btn-primary tasklist-create"><i class="fa fa-check"></i> Create New Task List</button>
			            </div>
			        </div>




                </div>
            </div>


        </div><!-- wrapper closes -->


        <div id="task-listing" class="modal fade">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Select Tasks</h4>
		            </div>
		            <div class="modal-body">
		            	<ul class="tree">
						@include('admin.tasklist.task-listing-partial', ['tasks' =>$tasks])
						</ul>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                <button type="button" data-dismiss="modal" class="btn btn-primary attach-selected-tasks" id="attach-selected-tasks">Select Tasks</button>
		            </div>
		        </div>
		    </div>
		</div>

		@include('admin.includes.footer')

	    @include('admin.includes.scripts')

		@include('site.includes.bugreport')

		
		<script type="text/javascript" src="/js/custom/tree.js"></script>
		<script type="text/javascript" src="/js/custom/admin/tasklist/addTasklist.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-custom/ckeditor.js"></script>

		<script type="text/javascript">

			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});
			CKEDITOR.replace('description');

		</script>

	</body>
	</html>
