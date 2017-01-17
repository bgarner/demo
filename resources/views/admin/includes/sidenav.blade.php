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

        @if ( Request::is('admin/user/*') || Request::is('admin/user')|| Request::is('admin/component/*') || Request::is('admin/component') || Request::is('admin/group/*') || Request::is('admin/group')) 
        <li class="active">
        @else
        <li>
        @endif
            <a href="/admin/group"><i class="fa fa-users"></i> <span class="nav-label">User and Group Management</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a href="/admin/user">View Users</a></li>
                <li><a href="/admin/component">View Components</a></li>
                <li><a href="/admin/group">View User Groups</a></li>
            </ul>
        </li>

    
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


</ul>
