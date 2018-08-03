@if (Request::is('admin/storestructure/*') || Request::is('admin/storestructure')||
	 Request::is('admin/store') || Request::is('admin/store/*') ||
	 Request::is('admin/district') || Request::is('admin/district/*') ||
	 Request::is('admin/region') || Request::is('admin/region/*')
	 ) 
<li class="active">
@else
<li>
@endif
    <a href="/admin/storestructure"><i class="fa fa-sitemap"></i> <span class="nav-label">Store Structure</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
    	<li><a href="/admin/storestructure">Store Structure</a></li>
        <li><a href="/admin/store">Store</a></li>
        <li><a href="/admin/district">District</a></li>
        <li><a href="/admin/region">Region</a></li>

    </ul>
</li>