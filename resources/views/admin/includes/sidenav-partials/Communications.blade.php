    @if (Request::is('admin/communication/*') || Request::is('admin/communication') || Request::is('admin/communicationtypes') || Request::is('/admin/communicationtypes/*'))
    <li class="active">
    @else
    <li>
    @endif
        <a href="/admin/communication"><i class="fa fa-bullhorn"></i> <span class="nav-label">Communications</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li><a href="/admin/communication">Manage Communications</a></li>
            <li><a href="/admin/communicationtypes">Manage Communication Types</a></li>
        </ul>
    </li>