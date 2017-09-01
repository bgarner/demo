@if (Request::is('admin/feature') || Request::is('admin/feature/*'))
    <li class="active">
    @else
    <li>
    @endif
        <a href="/admin/feature"><i class="fa fa-gift"></i> <span class="nav-label">Featured Content</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="/admin/package">Packages</a></li>
            <li><a href="/admin/feature">Features</a></li>
        </ul> 
    </li>