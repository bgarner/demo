<!DOCTYPE html>
<html>

<head>
    @section('title', 'Edit Task List')
    @include('admin.includes.head')
    <!-- <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css"> -->
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
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
                            <h5>Edit Task List</h5>

                            <div class="ibox-tools">

                            </div>
                        </div>
                        <div class="ibox-content">

							<form class="form-horizontal" id="updateTaskForm">

								<input type="hidden" id="tasklistId" name="tasklistId" value={{$tasklist->id}}>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Title</label>
						            <div class="col-sm-10"><input type="text" id="title" name="title" class="form-control" value="{{ $tasklist->title }}"></div>
								</div>

						        <div class="form-group">
									<label class="col-sm-2 control-label">Description</label>
										<div class="col-sm-10">
											<textarea class="communication_body" name="description" cols="50" rows="10" id="description">
												{{ $tasklist->description }}

											</textarea>

										</div>
								</div>

								<div class="hr-line-dashed"></div>
								

							</form>




                        </div> <!--  ibox content closes-->

                    </div><!-- ibox closes -->

                   <div class="ibox">
                    	<div class="ibox-title">
                    		<h5> Tasks </h5>
                    		<div class="ibox-tools">

                    			<div id="add-more-tasks" class="btn btn-primary btn-outline col-md-offset-8" role="button" ><i class="fa fa-plus"></i> Add More Tasks</div>
                    		</div>

                    	</div>
                    	<div class="ibox-content">
                        <div class="existing-tasks row" >
							
							<div class="existing-task-container">
								@include('admin.tasklist.task-partial', ['tasklist_tasks'=>$selected_tasks])

							</div>
							
							<div id="tasks-staged-to-remove"></div>

						</div>
						<div id="tasks-selected" class="row"></div>
						</div>

                    </div>

                    <div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<a class="btn btn-white" href="/admin/tasklist"><i class="fa fa-close"></i> Cancel</a>
							<button class="btn btn-primary tasklist-update"><i class="fa fa-check"></i> Update Task List</button>
			            </div>
			        </div>
                </div> <!-- col-lg-12 closes -->
            </div><!-- row closes -->


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


		<script type="text/javascript" src="/js/custom/admin/tasklist/editTasklist.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-custom/ckeditor.js"></script>
		<script type="text/javascript" src="/js/custom/tree.js"></script>

		<script type="text/javascript">
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});


    		CKEDITOR.replace('description');

		    $(".tree").treed({openedClass : 'fa fa-folder-open', closedClass : 'fa fa-folder'});



		</script>

	</body>
	</html>
