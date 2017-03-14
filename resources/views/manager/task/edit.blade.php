<form method="POST" action="/manager/task/{{$task->id}}">
	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Edit Task <i>{{$task->title}}</i></h4>
	</div>
	<div class="modal-body">


		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PATCH">

		<label for="title">Title</label>
		<input type="text" class="form-control" id="title_{{$task->id}}" name="title" value="{{$task->title}}" >
		
		
		<label for="due_date">Due Date</label>
		<span class="input-group">
			<input type="text" class="form-control due_date_selector" id="due_date_{{$task->id}}" name="due_date" value="{{$task->due_date}}" />
			<input type="text" name="send_reminder" id="send_reminder_{{$task->id}}" value="{{$task->send_reminder}}" hidden>
			<span  class="btn btn-white input-group-addon send_reminder" data-state="{{$task->send_reminder}}" data-task-id = "{{$task->id}}">
			@if($task->send_reminder)
				<i class="fa fa-check-square-o"></i>
			@else
				<i class="fa fa-square-o"></i>
			@endif
				Send Reminder
			</span>

		</span>

		<label for="target_stores">Stores</label>
		<br>
		{!! Form::select('target_stores[]', $stores, $task->stores, ['class'=>'chosen', 'multiple'=>'true']) !!}

	</div>
	<div class="modal-footer">

		<button type="button" class="btn btn-white cancel-modal" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
		<button class="btn btn-primary"><i class='fa fa-check'></i> Save changes</button>
	</div>
</form>