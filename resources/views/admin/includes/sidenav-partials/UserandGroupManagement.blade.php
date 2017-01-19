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