@if (Request::is('form') || Request::is('form/dashboard'))
<li class="active">
@else
<li>
@endif
    <a href="/form"><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span></a>
</li>
@if ( 	Request::is('form/user/*') || Request::is('form/user')||
		
		Request::is('form/group/*') || Request::is('form/group') 
		
	)
<li class="active">
@else
<li>
@endif
    <a href="/form/group"><i class="fa fa-users"></i> <span class="nav-label">User and Group</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="/form/user">Users</a></li>
        <li><a href="/form/group">Groups</a></li>
    </ul>
</li>
