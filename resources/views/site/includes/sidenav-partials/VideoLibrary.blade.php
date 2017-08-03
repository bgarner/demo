 @if (Request::segment(2) == 'video')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/video"><i class="fa fa-video-camera"></i> <span class="nav-label">{{__($component_label)}}</span></a>

                </li>