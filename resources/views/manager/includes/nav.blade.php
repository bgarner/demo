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


@if (Request::is('manager/alert/*') || Request::is('manager/alert') || Request::is('manager/urgentnotice') || Request::is('manager/urgentnotice/*')) 
<li class="active">
@else
<li>
@endif
    <a href="/manager/alert"><i class="fa fa-exclamation-triangle"></i> <span class="nav-label">Alerts and Notices</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="/manager/alert">Alerts</a></li>
        <li><a href="/manager/urgentnotice">Urgent Notices</a></li>
    </ul>
</li>


<!-- Tasks  -->
@if ( Request::is('manager/task/*') || Request::is('manager/task') || Request::is('manager/tasklist') || Request::is('/manager/tasklist/*') ) 
<li class="active">
@else
<li>
@endif
     <a href="/manager/task"><i class="fa fa-tasks"></i> <span class="nav-label">Tasks</span><span class="fa arrow"></span></a>
     <ul class="nav nav-second-level collapse">
        <li><a href="/manager/tasklist">Task Lists</a></li>
        <li><a href="/manager/task">Tasks</a></li>
    </ul>
</li>
