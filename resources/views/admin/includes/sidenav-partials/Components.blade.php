@if ( Request::is('admin') || Request::is('admin/storecomponents'))
<li class="active">
@else
<li>
@endif
    <a href="/admin/storecomponent"><i class="fa fa-home"></i> <span class="nav-label">Components</span></a>
</li>