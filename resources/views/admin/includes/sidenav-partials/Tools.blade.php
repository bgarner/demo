 @if (Request::is('admin/storegroup/*') || Request::is('admin/storegroup')) 
<li class="active">
@else
<li>
@endif
    <a href="/admin/storegroup"><i class="fa fa-comment"></i> <span class="nav-label">Tools</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="/admin/storegroup">Custom Store Groups</a></li>
    </ul>
</li>