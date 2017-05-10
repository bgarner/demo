@if ( 	Request::is('admin/user/*') || Request::is('admin/user')|| 
		Request::is('admin/component/*') || Request::is('admin/component') || 
		Request::is('admin/group/*') || Request::is('admin/group') ||
		Request::is('admin/role/*') || Request::is('admin/role') ||
		Request::is('admin/resource/*') || Request::is('admin/resource') 
	) 
<li class="active">
@else
<li>
@endif
    <a href="/admin/group"><i class="fa fa-users"></i> <span class="nav-label">User and Group Management</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="/admin/user">View Users</a></li>
        <li><a href="/admin/group">View Groups</a></li>
        <li><a href="/admin/role">View Roles</a></li>
        <li><a href="/admin/component">View Components</a></li>
        <li><a href="/admin/resource">View Resources</a></li>
    </ul>
</li>