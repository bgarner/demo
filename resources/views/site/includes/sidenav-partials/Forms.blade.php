@if (Request::segment(2) == 'form')
<li class="active">
@else
<li>
@endif
    <a href="/{{ Request::segment(1) }}/form" class="trackclick" data-tool-type="forms">
    	<i class="fa fa-paper-plane" aria-hidden="true"></i> <span class="nav-label">{{__($component_label)}}</span></a>
</li>