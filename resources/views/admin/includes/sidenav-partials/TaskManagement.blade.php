@if ( Request::is('admin/task/*') || Request::is('admin/task') ) 
<li class="active">
@else
<li>
@endif
     <a href="/admin/task"><i class="fa fa-tasks"></i> <span class="nav-label">Tasks</span></a>
</li>