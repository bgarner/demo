<!DOCTYPE html>
<html>

<head>
    @section('title', 'Create New Tasklist')
    @include('admin.includes.head')
    <link rel="stylesheet" type="text/css" href="/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/tree.css">
	<meta name="csrf-token" content="{!! csrf_token() !!}"/>
	<style>
	.stagedTask{
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
								<div class="form-group">
						                <label class="col-sm-2 control-label">Publish Date <span class="req">*</span></label>

						                <div class="col-sm-10">
						                    <div class="input-daterange input-group" id="datepicker">
						                        <input type="text" class="input-sm form-control datetimepicker-start" name="publish_date" id="publish_date" value="" />
						                    </div>
						                </div>
						        </div>
								<div class="form-group">
						                <label class="col-sm-2 control-label">Due Date <span class="req">*</span></label>

						                <div class="col-sm-10">
						                    <div class="input-daterange input-group" id="datepicker">
						                        <input type="text" class="input-sm form-control datetimepicker-end" name="due_date" id="due_date" value="" />
						                    </div>
						                </div>
						        </div>

								@include('admin.includes.the-ultimate-store-selector', ['optGroupOptions' => $optGroupOptions])

								<div class="hr-line-dashed"></div>
								<div class="input-group">
									<input type="text" class="form-control" name="new_task" id="new_task" value="" placeholder="Add Task..."/>
									<span class="input-group-addon" 
											style="width:2%;" 
											id="description_popover"
											title="Add Description">
											<i class="fa fa-comment"></i>
									</span>
									<span class="input-group-btn" >
										<a class="btn btn-primary btn-outline" id="add-task" onclick="stageTask()" >
										<i class="fa fa-plus"></i> Add Task</a>
									</span>
							    </div>
							    <div id="task-list">
							    	<table class="table table-hover task-table hidden ">
                                		<thead>
                                			<tr>
                                				<td>Title</td>
                                				<td></td>
                                				<td>Action</td>
                                			</tr>
                                		</thead>
                                		<tbody>
                                		</tbody>
                                	</table>
							    </div>

								<div class="hr-line-dashed"></div>

								<div class="form-group">
									<div class="col-sm-10 col-sm-offset-2">
										<a class="btn btn-white" href="/admin/tasklist"><i class="fa fa-close"></i> Cancel</a>
										<button class="btn btn-primary tasklist-create"><i class="fa fa-check"></i> Create New Task List</button>
						            </div>
						        </div>

							</form>




                        </div> <!-- ibox-content closes -->

                    </div><!-- ibox closes -->
                </div>
            </div>


        </div><!-- wrapper closes -->
        <div hidden>
	        <div id="description_container">
	        	<textarea name="task_description" id="task_description" cols="30" rows="10"></textarea>
	        </div>
        </div>

		@include('admin.includes.footer')

	    @include('admin.includes.scripts')

		@include('site.includes.bugreport')

		<script type="text/javascript" src="/js/vendor/moment.js"></script>
		<script type="text/javascript" src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="/js/plugins/ckeditor-custom/ckeditor.js"></script>
		<script type="text/javascript" src="/js/plugins/chosen/chosen.jquery.js"></script>
		
		<script type="text/javascript" src="/js/custom/tree.js"></script>
		<script type="text/javascript" src="/js/custom/datetimepicker-with-default-time.js"></script>
		<script type="text/javascript" src="/js/custom/admin/global/storeAndBannerSelector.js"></script>
		<script type="text/javascript" src="/js/custom/admin/tasklist/addTasklist.js"></script>

		<script type="text/javascript">

			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
			});

			$(".date").datetimepicker({
		          format: 'YYYY-MM-DD HH:mm:ss'
		    });

		    $(".chosen").chosen({
				  width:'75%'
			});

    		CKEDITOR.replace('description');

		</script>

	</body>
	</html>
