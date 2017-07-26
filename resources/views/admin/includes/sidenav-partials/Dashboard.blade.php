@if (Request::is('admin/dashboard') || Request::is('admin/dashboard/*'))
<li class="active">
@else
<li>
@endif
    <a href="/admin/dashboard"><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span></a>
</li>
