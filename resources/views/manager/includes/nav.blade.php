<ul class="nav metismenu" id="side-menu">

    <li class="nav-header">

        <div class="dropdown profile-element">

            <span class="text-xs block" style="padding-bottom: 10px; color: #DFE4ED;">
            Welcome, {{ Auth::user()->firstname }}!
            <a class="navbar-minimalize minimalize-styl-1 btn btn-primary pull-right" style="padding: 2px 4px; font-size: 8px;" href="#"><i class="fa fa-bars"></i> </a>
            </span>
            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="text-xs">
                    <i class="fa fa-sign-out"></i> Log out
                </span>
            </a>

            <br />


            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>

        </div>

        <div class="logo-element">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#" style="margin: 1px 5px 10px 15px;"><i class="fa fa-bars"></i></a>
            <br />
        </div>

    </li>
        @if($urgentNoticeCount > 0)
        <li class="urgetnNoticeNav animate-flicker">
            <a style="color: white" href="/{{ Request::segment(1) }}/urgentnotice"><i class="fa fa-bolt"></i> <span class="nav-label">URGENT NOTICE</span>
                @if(isset($urgentNoticeCount))
                <span class="label label-inverse pull-right">{{$urgentNoticeCount}}</span>
                @endif
            </a>
        </li>
        @endif

    
        <!-- Dashboard  -->
        @if (Request::is('manager/dashboard') || Request::is('manager/dashboard/*'))
        <li class="active">
        @else
        <li>
        @endif
            <a href="/manager/dashboard"><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span></a>
        </li>


        <!-- Calendar  -->

        @if (  Request::is('manager/calendar/*') || 
            Request::is('manager/calendar') || 
            Request::is('manager/productlaunch') || 
            Request::is('manager/productlaunch/*')
            ) 
        <li class="active">
        @else
        <li>
        @endif
            <a href="/manager/calendar"><i class="fa fa-calendar"></i> <span class="nav-label">Calendar</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a href="/manager/calendar">Events</a></li>
                <li><a href="/manager/productlaunch">Product Launches</a></li>
            </ul>
        </li>


        <!-- Communication  -->


        @if (Request::is('manager/communication/*') || Request::is('manager/communication') )
        <li class="active">
        @else
        <li>
        @endif
        	<a href="/manager/communication"><i class="fa fa-bullhorn"></i> <span class="nav-label">Communications</span></a>
        </li>


        <!-- Alerts and Notices  -->


        @if (Request::is('manager/alert/*') || Request::is('manager/alert')) 
        <li class="active">
        @else
        <li>
        @endif
            <a href="/manager/alert"><i class="fa fa-exclamation-triangle"></i> <span class="nav-label">Alerts</span>
            </a>
        </li>

        @if (Request::is('manager/document/*') || Request::is('manager/document'))

        <li class="active">
        @else
        <li>
        @endif
            <a href="/manager/document"><i class="fa fa-book"></i> <span class="nav-label">Library</span></a>
        </li>
    


        <!-- Tasks  -->
        @if ( Request::is('manager/task/*') || Request::is('manager/task') || Request::is('manager/tasklist') || Request::is('/manager/tasklist/*') ) 
        <li class="active">
        @else
        <li>
        @endif
            <a href="/manager/task"><i class="fa fa-tasks"></i> <span class="nav-label">Tasks</span></a>
             
        </li>

</ul>