@if (Request::is('form') || Request::is('form/dashboard'))
<li class="active">
@else
<li>
@endif
    <a href="/form"><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span></a>
</li>

