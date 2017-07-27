@if($urgentNoticeCount > 0)
                <li class="urgetnNoticeNav">
                    <a style="color: white" href="/{{ Request::segment(1) }}/urgentnotice"><i class="fa fa-bolt"></i> <span class="nav-label">{{__($component_label)}}</span>
                        @if(isset($urgentNoticeCount))
                        <span class="label label-inverse pull-right">{{$urgentNoticeCount}}</span>
                        @endif
                    </a>
                </li>
                @endif