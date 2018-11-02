@if (Request::segment(2) == 'storevisitreport')
<li class="active">
@else
<li>
@endif
    <a href="/{{ Request::segment(1) }}/storevisitreport" class="trackclick" data-tool-type="forms">
        <i class="fa fa-clipboard" aria-hidden="true"></i> <span class="nav-label">{{__($component_label)}}</span></a>
</li>