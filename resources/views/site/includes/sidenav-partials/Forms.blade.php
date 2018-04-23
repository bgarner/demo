@if (Request::segment(2) == 'forms' && $isFormComponentVisible)
<li class="active">
@else
<li>
@endif
    <a href="/{{ Request::segment(1) }}/form" class="trackclick" data-tool-type="forms">
    	<i class="fa fa-paper-plane-o" aria-hidden="true"></i> <span class="nav-label">{{__($component_label)}}</span></a>
        
</li>
