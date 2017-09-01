 @if (  Request::is('admin/calendar/*') || 
        Request::is('admin/calendar') || 
        Request::is('admin/eventtypes') || 
        Request::is('admin/productlaunch') || 
        Request::is('admin/eventtypes/*') || 
        Request::is('admin/productlaunch/*')
        ) 
    <li class="active">
    @else
    <li>
    @endif
        <a href="/admin/calendar"><i class="fa fa-calendar"></i> <span class="nav-label">Calendar</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="/admin/calendar">Events</a></li>
            <li><a href="/admin/eventtypes">Event Types</a></li>
            <li><a href="/admin/productlaunch">Product Launches</a></li>
        </ul>
    </li>

