@if (Request::is('admin/document/*') || Request::is('admin/document'))

<li class="active">
@else
<li>
@endif
    <a href="/admin/document/manager"><i class="fa fa-book"></i> <span class="nav-label">Library</span></a>
</li>
    