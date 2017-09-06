 @if (Request::is('admin/feedback/*') || Request::is('admin/feedback')) 
<li class="active">
@else
<li>
@endif
    <a href="/admin/feedback"><i class="fa fa-comment"></i> <span class="nav-label">Store Feedback Management</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        <li><a href="/admin/feedback">Feedback</a></li>
    </ul>
</li>