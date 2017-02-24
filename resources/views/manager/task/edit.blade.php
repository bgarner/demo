<!-- <div class="modal fade" id="edit-task-modal">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Task</h4>
            </div>
            <div class="modal-body"> -->
            	<form method="POST" action="/manager/task/{{$task->id}}">

            		<input type="hidden" name="_token" value="{{ csrf_token() }}">
            		<input type="hidden" name="_method" value="PATCH">

					<label for="title">Title</label>
					<input type="text" class="form-control" id="title_{{$task->id}}" name="title" value="{{$task->title}}" >
					
					
					<label for="due_date">Due Date</label>
					<span class="input-group">
					<input type="text" class="form-control due_date_selector" id="due_date_{{$task->id}}" name="due_date" value="{{$task->due_date}}">
					<span  class="btn btn-white input-group-addon" id="send_reminder" data-state="{{$task->send_reminder}}">
					@if($task->send_reminder)
						<i class="fa fa-check-square-o"></i>
					@else
						<i class="fa fa-square-o"></i>
					@endif
						Send Reminder
					</span>

					</span>

					<label for="store_select">Stores</label>
					{!! Form::select('store_select', $stores, $task->stores, ['class'=>'chosen', 'multiple'=>'true']) !!}
				</form>
			<!-- </div>
	        <div class="modal-footer"> -->
	            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
	            <input type="submit" class="btn btn-primary" value="Update Task"/>
	        <!-- </div>
	    </div>
	</div>

</div> -->