@if (Request::segment(2) == 'tasks')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/tasks"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span class="nav-label">{{__($component_label)}}</span>
                    @if( isset($alertCount) )
                        @if( $taskDueTodayCount > 0)
                            <span class="label label-primary pull-right">{{ $allTasksDueCount }}</span>
                        @else
                            <span class="label label-inverse pull-right">{{ $allTasksDueCount }}</span>
                        @endif
                    @endif
                    </a>
                </li>