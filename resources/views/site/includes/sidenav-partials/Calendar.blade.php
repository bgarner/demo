@if (Request::segment(2) == 'calendar')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/calendar"><i class="fa fa-calendar"></i> <span class="nav-label">{{__($component_label)}}</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" style="height: 0px;">
                            <li><a href="/{{ Request::segment(1) }}/calendar">{{  __("Calendar") }}</a></li>

                            <li><a href="/{{ Request::segment(1) }}/calendar/productlaunch">{{__("Product Launch")}}</a></li>
                        </ul>
                </li>