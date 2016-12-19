
            <ul class="nav metismenu" id="side-menu">
                <a href="/{{ Request::segment(1) }}">
                <li class="nav-header">
                    <!-- <div class="logo-element">
                        
                    </div> -->
                </li>
                </a>


                @if($urgentNoticeCount > 0)
                <li class="urgetnNoticeNav">
                    <a style="color: white" href="/{{ Request::segment(1) }}/urgentnotice"><i class="fa fa-bolt"></i> <span class="nav-label">URGENT NOTICE</span>
                        @if(isset($urgentNoticeCount))
                        <span class="label label-inverse pull-right">{{$urgentNoticeCount}}</span>
                        @endif
                    </a>
                </li>
                @endif

                @if ( Request::is( Request::segment(1) ) )
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}"><i class="fa fa-home"></i> <span class="nav-label">Dashboard</span></a>
                </li>


                @if (Request::segment(2) == 'calendar')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/calendar"><i class="fa fa-calendar"></i> <span class="nav-label">Calendar</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" style="height: 0px;">
                            <li><a href="/{{ Request::segment(1) }}/calendar">Calendar</a></li>
                        
                            <li><a href="/{{ Request::segment(1) }}/calendar/productlaunch">Product Launch</a></li>
                        </ul>
                </li>


                @if (Request::segment(2) == 'communication')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/communication"><i class="fa fa-bullhorn"></i> <span class="nav-label">Communications</span>
                    @if( isset($communicationCount) )
                    <span class="label label-inverse pull-right">{{ $communicationCount }}</span>
                    @endif
                    </a>
                </li>


                @if (Request::segment(2) == 'alerts')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/alerts"><i class="fa fa-bell"></i> <span class="nav-label">Alerts</span>
                    @if( isset($alertCount) )
                        @if( $alertCount > 0)
                            <span class="label label-primary pull-right">{{ $alertCount }}</span>
                        @else
                            <span class="label label-inverse pull-right">{{ $alertCount }}</span>
                        @endif
                    @endif
                    </a>
                </li>


                @if (Request::segment(2) == 'document')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/document"><i class="fa fa-book"></i> <span class="nav-label">Library</span></a>
                </li>


                @if (Request::segment(2) == 'video')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/video"><i class="fa fa-video-camera"></i> <span class="nav-label">Video Library</span></a>

                </li>

                @if (Request::segment(2) == 'community')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="/{{ Request::segment(1) }}/community"><i class="fa fa-users"></i> <span class="nav-label">Community</span></a>

                </li>

                @if (Request::segment(2) == 'tools')
                <li class="active">
                @else
                <li>
                @endif
                    <a href="#"><i class="fa fa-wrench" aria-hidden="true"></i> <span class="nav-label">Tools</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" style="height: 0px;">
                            <li><a href="/{{ Request::segment(1) }}/tools/blackfriday">Door-Crasher Tracker</a></li>
                        </ul>
                    
                </li>                                

            </ul>
