@if (Request::segment(2) == 'flyer')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/flyer"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <span class="nav-label">{{__($component_label)}}</span></a>
                </li>         