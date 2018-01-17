 @if ( Request::is( Request::segment(1) ) )
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}"><i class="fa fa-home"></i> <span class="nav-label">{{__($component_label)}}</span></a>
                </li>