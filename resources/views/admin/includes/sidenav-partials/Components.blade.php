@if ( Request::is('admin') || Request::is('admin/storecomponents'))
<li class="active">
@else
<li>
@endif
    <a href="/admin/storecomponent"><i class="fa fa-puzzle-piece"></i> <span class="nav-label">Components</span></a>
</li>