<div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
    @include('site.tasks.tasksidebar')
</div>
<div class="col-lg-10 col-md-9 col-sm-8 col-xs-8 ">
                     
    <div class="mail-box-header clearfix">
        <h2>
        @if(!isset($title))
            {{__("All Tasks")}} <small>({{ count($allIncompleteTasks) }} incomplete)</small> 
        @else
            {{ $title }}  <small>({{ count($incompleteTasksInList) }} incomplete) </small>
        @endif
        </h2>
    </div>
    <div class="mail-box clearfix">
                            

            <h4>{{__("Tasks Due Today")}}</h4>
            <ul class="todo-list m-t">
                @foreach($tasksDueToday as $task)
                    <li>
                        <a href="" class="check-link trackclick" data-task-id="{{$task->id}}" data-task-completed="not done"><i class="fa fa-square-o"></i></a>
                        <span class="m-l-xs"><strong>{{$task->title}} </strong></span>
                        <small class="label label-danger due-date"><i class="fa fa-clock-o due-date-icon"></i>&nbsp;<span class="due-date-text">{{$task->pretty_due_date}}</span></small>
                        <div class="task_description">{!! $task->description !!}</div>
                        @if(isset($task->documents))
                        <div class="task_documents">
                        
                            @foreach($task->documents as $doc)
                                {!! $doc->link_with_icon !!}
                            @endforeach
                        
                        </div>
                        @endif
                    </li>
                @endforeach
            </ul>
            <br>

            <h4>{{__("Upcoming Tasks")}}</h4>
            <ul class="todo-list m-t">
                @foreach($tasksDue as $task)
                    <li>
                        <a href="" class="check-link trackclick" data-task-id="{{$task->id}}" data-task-completed="not done"><i class="fa fa-square-o"></i></a>
                        <span class="m-l-xs"><strong>{{$task->title}} </strong></span>
                        <small class="label label-primary due-date"><i class="fa fa-clock-o due-date-icon"></i>&nbsp;<span class="due-date-text">{{$task->pretty_due_date}}</span></small>
                        <div class="task_description">{!! $task->description !!}</div>
                        @if(isset($task->documents))
                        <div class="task_documents">
                        
                            @foreach($task->documents as $doc)
                                {!! $doc->link_with_icon !!}
                            @endforeach
                        
                        </div>
                        @endif
                    </li>
                @endforeach
            </ul>
            <br>

            <h4>{{__("Completed Tasks")}}</h4>
            <ul class="todo-list m-t">
                @foreach($tasksCompleted as $task)
                    <li>
                        <a href="" class="check-link trackclick" data-task-id="{{$task->id}}" data-task-completed="done"><i class="fa fa-check-square"></i></a>
                        <span class="todo-completed"><strong>{{$task->title}} </strong></span>
                        <small class="label label-default due-date"><i class="fa fa-check due-date-icon"></i>&nbsp;<span class="due-date-text">{{$task->pretty_completed_date}}</span></small>
                        <div class="task_description">{!! $task->description !!}</div>
                        @if(isset($task->documents))
                        <div class="task_documents">
                        
                            @foreach($task->documents as $doc)
                                {!! $doc->link_with_icon !!}
                            @endforeach
                        
                        </div>
                        @endif
                    </li>
                @endforeach
            </ul>

    </div>
</div>