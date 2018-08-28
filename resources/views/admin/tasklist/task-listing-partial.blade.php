@if(count($tasks)>0)
	@foreach($tasks as $task)
		<div class="task_item">
		<input type="checkbox" class="task-checkbox" name = "tasklist_tasks[]" value = "{{$task['id']}}" data-taskid = '{{$task["id"]}}' data-tasktitle = "{{$task['title']}}"  > {{$task["title"]}} 
		</div>
	@endforeach
@endif