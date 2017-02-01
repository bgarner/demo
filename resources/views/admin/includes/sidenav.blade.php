<ul class="nav metismenu" id="side-menu">
    <li class="nav-header">
        <div class="dropdown profile-element"> 
            {{-- <span>
                <img alt="image" class="img-circle" src="/wireframes/img/profile_small.jpg" />
            </span> --}}
            <a data-toggle="dropdown" class="" href="#">
                <span class="clear">
                    <span class="block m-t-xs">
                    <center>
                    <img src="/images/fgl.png" />
                    </center>
                    </span>

                  <span class="text-muted text-xs block"></span><br />
                 <a href="profile"><span class="text-muted text-xs"></span></a>  
                 <!-- <a href="/admin/logout"><span class="text-muted text-xs pull-right"> <i class="fa fa-sign-out"></i> Log out</span></a>  -->
        </div>

        <div class="logo-element">
            F
        </div>
    </li>



    @if ( Request::is('admin') || Request::is('admin/home'))
    <li class="active">
    @else
    <li>
    @endif
        <a href="/admin"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
    </li>


    @if (Request::is('admin/dashboard') || Request::is('admin/dashboard/*'))
    <li class="active">
    @else
    <li>
    @endif
        <a href="/admin/dashboard"><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span></a>
    </li>


    <!-- FEATURES -->

    @if (Request::is('admin/feature') || Request::is('admin/feature/*'))
    <li class="active">
    @else
    <li>
    @endif
        <a href="/admin/feature"><i class="fa fa-gift"></i> <span class="nav-label">Featured Content</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="/admin/package">Manage Packages</a></li>
            <li><a href="/admin/feature">Feature Manager</a></li>
        </ul> 
    </li>


        <!-- CALENDAR NAV -->
    @if (Request::is('admin/calendar/*') || Request::is('admin/calendar') || Request::is('admin/eventtypes') || Request::is('admin/eventtypes/*')) 
    <li class="active">
    @else
    <li>
    @endif
        <a href="/admin/calendar"><i class="fa fa-calendar"></i> <span class="nav-label">Calendar</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="/admin/calendar">Manage Events</a></li>
            <li><a href="/admin/eventtypes">Manage Event Types</a></li>
            <li><a href="/admin/productlaunch">Manage Product Launches</a></li>
        </ul>
    </li>

    @if (Request::is('admin/communication/*') || Request::is('admin/communication') || Request::is('admin/communicationtypes') || Request::is('/admin/communicationtypes/*'))
    <li class="active">
    @else
    <li>
    @endif
        <a href="/admin/communication"><i class="fa fa-bullhorn"></i> <span class="nav-label">Communications</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="/admin/communication">Manage Communications</a></li>
            <li><a href="/admin/communicationtypes">Manage Communication Types</a></li>
        </ul>
    </li>


    @if (Request::is('admin/document/*') || Request::is('admin/document'))

    <li class="active">
    @else
    <li>
    @endif
        <a href="/admin/document/manager"><i class="fa fa-book"></i> <span class="nav-label">Library</span></a>
    </li>
    

    @if (Request::is('admin/alert/*') || Request::is('admin/alert') || Request::is('admin/urgentnotice') || Request::is('admin/urgentnotice/*')) 
    <li class="active">
    @else
    <li>
    @endif
        <a href="/admin/alert"><i class="fa fa-exclamation-triangle"></i> <span class="nav-label">Alerts and Notices</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="/admin/alert">Manage Alerts</a></li>
            <li><a href="/admin/urgentnotice">Manage Urgent Notices</a></li>
        </ul>
    </li>
    @if (Request::is('admin/video/*') || Request::is('admin/video') || Request::is('admin/tag') || Request::is('admin/tag/*') || Request::is('admin/playlist') || Request::is('admin/playlist/*') ) 
    <li class="active">
    @else
    <li>
    @endif
        <a href="/admin/video"><i class="fa fa-film"></i> <span class="nav-label">Videos</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="/admin/video">Manage Videos</a></li>
            <li><a href="/admin/tag">Manage Tags</a></li>
            <li><a href="/admin/playlist">Manage Playlists</a></li>
        </ul>
    </li>

    @if (Auth::user()->group_id == 1)
        @if (Request::is('admin/user/*') || Request::is('admin/user')) 
        <li class="active">
        @else
        <li>
        @endif
            <a href="/admin/user"><i class="fa fa-user"></i> <span class="nav-label">User Management</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a href="/admin/user">View Users</a></li>
            </ul>
        </li>
    @endif

    @if (Auth::user()->group_id == 1)
        @if (Request::is('admin/feedback/*') || Request::is('admin/feedback')) 
        <li class="active">
        @else
        <li>
        @endif
            <a href="/admin/feedback"><i class="fa fa-comment"></i> <span class="nav-label">Store Feedback Management</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a href="/admin/feedback">View Feedback</a></li>
            </ul>
        </li>
    @endif


    {{-- <li>
        <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">Analytics</span></a>
    </li> --}}



{{--                 <li>
        <a href="mailbox.html"><i class="fa fa-envelope"></i> <span class="nav-label">Messages </span><span class="label label-warning pull-right">5</span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="mailbox.html">Inbox</a></li>
            <li><a href="mail_detail.html">Email view</a></li>
            <li><a href="mail_compose.html">Compose email</a></li>
            <li><a href="email_template.html">Email templates</a></li>
        </ul>
    </li>     --}}






{{--                 <li class="">
        <a href="index.html"><i class="fa fa-check-square-o"></i> <span class="nav-label">Tasks</span></a>
    </li>        --}}

{{--                 <li>
        <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">My Store</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="graph_flot.html">Store Profile</a></li>
            <li><a href="graph_morris.html">Store Staff</a></li>
        </ul>
    </li> --}}

{{--                 <li>
        <a href="#"><i class="fa fa-futbol-o"></i> <span class="nav-label">My Activities</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="graph_flot.html">Activity Profile</a></li>
            <li><a href="graph_morris.html">Log an Activity</a></li>
            <li><a href="graph_morris.html">Coaches for Communities</a></li>
        </ul>
    </li>     --}}

{{--                 <li>
        <a href="#"><i class="fa fa-rocket"></i> <span class="nav-label">My Career</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="graph_flot.html">My Store Profile</a></li>
            <li><a href="graph_morris.html">My Store Staff</a></li>
        </ul>
    </li>    --}}
{{--
    <li>
        <a href="#"><i class="fa fa-certificate"></i> <span class="nav-label">My Training</span></a>
    </li> --}}

{{--                 <li>
        <a href=""><i class="fa fa-lightbulb-o"></i> <span class="nav-label">Idea Factory</span></a>
    </li> --}}

{{--                 <li>
        <a href="#"><i class="fa fa-comments-o"></i> <span class="nav-label">Neighbourhoods</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="graph_flot.html">Jumpstart <span class="label label-primary pull-right">12</span></a></li>
            <li><a href="graph_morris.html">Living Healthy <span class="label label-primary pull-right">27</span></a></li>
        </ul>
    </li>    --}}

</ul>
