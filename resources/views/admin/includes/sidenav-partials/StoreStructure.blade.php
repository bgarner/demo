@if ( Request::is('admin/storestructure') || Request::is('admin/storestructure'))
<li class="active">
@else
<li>
@endif
    <a href="/admin/storestructure"><i class="fa fa-sitemap"></i> <span class="nav-label">Store Structure</span></a>
</li>