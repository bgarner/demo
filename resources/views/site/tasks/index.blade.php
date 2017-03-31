<!DOCTYPE html>
<html>

<head>
    @section('title', 'Tasks')
    @include('site.includes.head')
</head>

<body class="fixed-navigation">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('site.includes.sidenav');
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>


        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Tasks</h2>

            </div>
            <div class="col-lg-2">

            </div>
        </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <!-- <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">

            side bar

            </div> -->
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated fadeInRight">
                    <h4>Tasks Due Today</h4>
                    <ul class="todo-list m-t">
                        @foreach($tasksDueToday as $task)
                            <li>
                                <a href="" class="check-link"><i class="fa fa-square-o"></i></a>
                                <span class="m-l-xs"><strong>{{$task->title}} </strong></span>
                                <small class="label label-danger due-date"><i class="fa fa-clock-o due-date-icon"></i>&nbsp;<span class="due-date-text">{{$task->pretty_due_date}}</span></small>
                                <div class="task_description">{!! $task->description !!}</div>
                            </li>
                        @endforeach
                    </ul>
                    <br>
                 
                    <h4>Upcoming Tasks</h4>
                    <ul class="todo-list m-t">
                        @foreach($tasksDue as $task)
                            <li>
                                <a href="" class="check-link"><i class="fa fa-square-o"></i></a>
                                <span class="m-l-xs"><strong>{{$task->title}} </strong></span>
                                <small class="label label-primary due-date"><i class="fa fa-clock-o due-date-icon"></i>&nbsp;<span class="due-date-text">{{$task->pretty_due_date}}</span></small>
                                <div class="task_description">{!! $task->description !!}</div>
                            </li>
                        @endforeach
                    </ul>

                    <h4>Completed Tasks</h4>
                    <ul class="todo-list m-t">
                        @foreach($tasksCompleted as $task)
                            <li>
                                <a href="" class="check-link"><i class="fa fa-check-square"></i></a>
                                <span class="todo-completed"><strong>{{$task->title}} </strong></span>
                                <small class="label label-default due-date"><i class="fa fa-check due-date-icon"></i>&nbsp;<span class="due-date-text">{{$task->pretty_completed_date}}</span></small>
                                <div class="task_description">{!! $task->description !!}</div>
                            </li>
                        @endforeach
                    </ul>


            </div>
        </div>
    </div>

    @include('site.includes.footer')
    @include('site.includes.scripts')
    @include('site.includes.modal')

</body>
</html>
