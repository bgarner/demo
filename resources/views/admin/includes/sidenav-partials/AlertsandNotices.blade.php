@if (Request::is('admin/alert/*') || Request::is('admin/alert') || Request::is('admin/urgentnotice') || Request::is('admin/urgentnotice/*')) 
<li class="active">
@else
<li>
@endif
    <a href="/admin/alert"><i class="fa fa-exclamation-triangle"></i> <span class="nav-label">Alerts and Notices</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="/admin/alert">Alerts</a></li>
         <li><a href="/admin/alerttypes">Alert Types</a></li>
        <li><a href="/admin/urgentnotice">Urgent Notices</a></li>
    </ul>
</li>
