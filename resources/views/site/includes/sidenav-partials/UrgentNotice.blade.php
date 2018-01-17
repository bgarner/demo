                @if($urgentNoticeCount > 0)
                <li class="urgetnNoticeNav animate-flicker">
                    <a style="color: white" href="/{{ Request::segment(1) }}/urgentnotice"><i class="fa fa-bolt"></i> <span class="nav-label">URGENT NOTICE</span>
                        @if(isset($urgentNoticeCount))
                        <span class="label label-inverse pull-right">{{$urgentNoticeCount}}</span>
                        @endif
                    </a>
                </li>
                @endif