@if(count($tasklist_tasks) > 0)
<table class="table table-hover task-table">
@else
<table class="table table-hover task-table hidden">
@endif
	<thead>
		<tr>
			<td>Title</td>
			<td></td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>
		@foreach($tasklist_tasks as $task)
		<tr class="tasklist-task" data-taskid="{{$task->id}}">
			<td class="col-sm-10 col-sm-offset-2 task-title" data-taskid="{{$task->id}}">
            	{!! $task->title !!}
            </td>
			<td></td>
			<td>
				<a data-task-id="{{ $task->id }}" id="task{{$task->id}}" class="remove-task btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>