<form method="POST" action="/manager/task/{{$task->id}}">
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Task <i>{{$task->title}}</i></h4>
</div>
<div class="modal-body">
	<div class="form-container">

		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="_method" value="PATCH">

		<label for="title">Title</label>
		<input type="text" class="form-control" id="title_{{$task->id}}" name="title" value="{{$task->title}}" >
		
		
		<label for="due_date">Publish Date</label>
		<input type="text" class="form-control publish_date_selector" id="publish_date_{{$task->id}}" name="publish_date" value="{{$task->publish_date}}" />

		<label for="due_date">Due Date</label>
		<input type="text" class="form-control due_date_selector" id="due_date_{{$task->id}}" name="due_date" value="{{$task->due_date}}" />
			
					

		<label for="target_stores">Stores</label>
		<br>
		{!! Form::select('target_stores[]', $stores, $task->stores, ['class'=>'chosen', 'multiple'=>'true', 'id'=>'storeSelect_{{$task->id}}']) !!}
		
		<label for="description">Description</label>
		<textarea name="description" id="description_{{$task->id}}" cols="30" rows="10" value="{{$task->description}}"></textarea>
	</div>
</div>
<div class="modal-footer">

	<button type="button" class="btn btn-white cancel-modal" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
	<button class="btn btn-primary"><i class='fa fa-check'></i> Save changes</button>
</div>
</form>