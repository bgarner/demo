@if (Request::is('admin/video/*') || 
	 Request::is('admin/video') || 
	 Request::is('admin/playlist') || 
	 Request::is('admin/playlist/*')) 
<li class="active">
@else
<li>
@endif
    <a href="/admin/video"><i class="fa fa-film"></i> <span class="nav-label">Videos</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="/admin/video">Videos</a></li>
        <!-- <li><a href="/admin/tag">Tags</a></li> -->
        <li><a href="/admin/playlist">Playlists</a></li>
    </ul>
</li>