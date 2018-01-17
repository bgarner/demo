<div class="ibox">
    <div class="ibox-title">
        <h2>Tasks</h2>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">


        <div class="row">
            <div class="col-md-12">


                <table class="table table-stripped" id="task_analytics">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Due Date</th>
                            <th>Completed</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($taskStats as $task)
                        @if( $task->due_date < $today)
                            <tr class="task-details-control overdue_task">
                        @else
                            <tr class="task-details-control">
                        @endif
                            <td>
                                @if(isset($task->tasklist))
                                    <small class="label label-sm label-inverse">{{ $task->tasklist }}</small>&nbsp;&nbsp;
                                @endif
                            </td>
                            <td>{{ $task->title }}</td>
                            <td class="faa-parent animated-hover">

                                @if( $task->due_date < $today)
                                    <i class="fa fa-bell-o faa-shake"></i>
                                @endif
                                {{ $task->due_date }}

                            </td>
                            <td data-order="{{$task->readPerc}}" data-read-perc = {{$task->readPerc}}>

                                <canvas id="taskChart_{{ $task->id }}" width="45" height="45" style="width: 45px; height: 45px;"></canvas>
                            </td>
                            <td >{{$task->opened}}</td>
                            <td >{{$task->unopened}}</td>
                            <td >{{$task->sent_to}}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>

</div>