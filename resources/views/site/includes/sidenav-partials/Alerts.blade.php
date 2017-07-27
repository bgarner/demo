@if (Request::segment(2) == 'alerts')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/alerts"><i class="fa fa-bell"></i> <span class="nav-label">{{__($component_label)}}</span>
                    @if( isset($alertCount) )
                        @if( $alertCount > 0)
                            <span class="label label-primary pull-right">{{ $alertCount }}</span>
                        @else
                            <span class="label label-inverse pull-right">{{ $alertCount }}</span>
                        @endif
                    @endif
                    </a>
                </li>