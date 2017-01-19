@if ( Request::is('admin') || Request::is('admin/home'))
<li class="active">
@else
<li>
@endif
    <a href="/admin"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
</li>