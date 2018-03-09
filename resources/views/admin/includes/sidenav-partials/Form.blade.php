@if (Request::is('admin/form/*') || Request::is('admin/form'))

<li class="active">
@else
<li>
@endif
<a href="/admin/formlist"><i class="fa fa-paper-plane-o"></i> <span class="nav-label">Forms</span></a>
</li>
