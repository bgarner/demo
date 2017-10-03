@if ( Request::is('admin/task/*') || Request::is('admin/task') || Request::is('admin/tasklist') || Request::is('/admin/tasklist/*') ) 
<li class="active">
@else
<li>
@endif
     <a href="/admin/task"><i class="fa fa-tasks"></i> <span class="nav-label">Tasks</span><span class="fa arrow"></span></a>
     <ul class="nav nav-second-level collapse">
        <li><a href="/admin/tasklist">Task Lists</a></li>
        <li><a href="/admin/task">Tasks</a></li>
    </ul>
</li>