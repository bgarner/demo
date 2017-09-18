@if (Request::segment(2) == 'training')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/training"><i class="fa fa-graduation-cap"></i> <span class="nav-label">{{__($component_label)}}</span></a>
                </li>