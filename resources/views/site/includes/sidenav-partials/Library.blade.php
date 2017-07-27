@if (Request::segment(2) == 'document')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/document"><i class="fa fa-book"></i> <span class="nav-label">{{__($component_label)}}</span></a>
                </li>