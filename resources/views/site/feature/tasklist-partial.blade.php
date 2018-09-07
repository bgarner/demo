<div class="ibox" id="task-container">
    <div class="ibox-title">
        <h2>Tasks</h2>
    </div>
    <div class="ibox-content">
        <div class="feed-activity-list" >
            @if(count($tasklists)>0)
                @foreach($tasklists as $tasklist)
                    <div class="feed-element">
                        <div class="media-body">
                            
                            <h4>{{__("Upcoming Tasks")}}</h4>
                            <ul class="todo-list m-t">

                            @foreach($tasklist->incompleteTasks as $task)
                                <li>
                                    <a href="" class="check-link pull-left" data-task-id="{{$task->id}}" data-task-completed="not done"><i class="fa fa-square-o"></i></a>
                                    <span class="m-l-xs pull-left task-title"><strong>{{$task->title}} </strong></span>

                                    <div class="label label-primary due-date pull-right">
                                        <i class="fa fa-clock-o due-date-icon"></i>&nbsp;<span class="due-date-text">{{$task->pretty_due_date}}</span>
                                    </div>

                                    <div class="task_description clearfix">{!! $task->description !!}</div>
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
                            @if(count($tasklist->completedTasks)>0)
                            <h4>{{__("Completed Tasks")}}</h4>
                            <ul class="todo-list m-t">
                            @foreach($tasklist->completedTasks as $task)
                                <li>
                                    <a href="" class="check-link pull-left" data-task-id="{{$task->id}}" data-task-completed="done"><i class="fa fa-check-square"></i></a>
                                    <span class="m-l-xs todo-completed pull-left task-title"><strong>{{$task->title}} </strong></span>

                                    <small class="label label-default pull-right due-date">
                                        <i class="fa fa-check due-date-icon"></i>&nbsp;<span class="due-date-text">{{$task->pretty_completed_date}}</span>
                                    </small>

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
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>