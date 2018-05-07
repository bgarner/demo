 @if (Request::is('admin/storegroup/*') || Request::is('admin/storegroup')||
	 Request::is('admin/tag') ||
	 Request::is('admin/tag/*') ) 
<li class="active">
@else
<li>
@endif
    <a href="/admin/storegroup"><i class="fa fa-comment"></i> <span class="nav-label">Tools</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="/admin/storegroup">Custom Store Groups</a></li>
        <li><a href="/admin/tag">Tags</a></li>
        <li><a href="/admin/dirtynodes">Dirty Nodes</a></li>
    </ul>
</li>