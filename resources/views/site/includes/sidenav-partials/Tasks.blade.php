@if (Request::segment(2) == 'task')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/task"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span class="nav-label">{{__($component_label)}}</span>
                    
                    <span class="label label-inverse pull-right " id="sidenav-task-count">{{$incompleteTaskCount}} / {{ $incompleteTaskCount+ $completedTaskCount }}</span>
                        
                    </a>
                </li>