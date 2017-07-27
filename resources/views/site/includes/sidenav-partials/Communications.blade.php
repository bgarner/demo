@if (Request::segment(2) == 'communication')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/communication"><i class="fa fa-bullhorn"></i> <span class="nav-label">{{__($component_label)}}</span>
                    @if( isset($communicationCount) )
                    <span class="label label-inverse pull-right">{{ $communicationCount }}</span>
                    @endif
                    </a>
                </li>