@if (Request::is('admin/batchfileupload/*') || Request::is('admin/batchfileupload'))
<li class="active">
@else
<li>
@endif
    <a href="/admin/batchfileupload"><i class="fa fa-upload"></i> <span class="nav-label">Batch Upload</span></a>
</li>
