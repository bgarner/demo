@if (Request::is('admin/flyer/*') || Request::is('admin/flyer'))

<li class="active">
@else
<li>
@endif
<a href="/admin/flyer"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Flyer</span></a>
</li>