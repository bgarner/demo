@if (Request::segment(2) == 'community')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/community"><i class="fa fa-users"></i> <span class="nav-label">{{__($component_label)}}</span></a>

                </li>