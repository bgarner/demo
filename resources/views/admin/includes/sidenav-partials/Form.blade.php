@if (Request::is('admin/form/*') || Request::is('admin/form'))

<li class="active">
@else
<li>
@endif
<a href="/admin/form"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Form</span></a>
</li>