@if (Request::segment(2) == 'tools')
<li class="active">
@else
<li>
@endif
    <a href="#"><i class="fa fa-wrench" aria-hidden="true"></i> <span class="nav-label">{{__($component_label)}}</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse" style="height: 0px;">
            <li><a href="/{{ Request::segment(1) }}/tools/boxingday" class="trackclick" data-tool-type="doorcrasherTracker">Doorcrasher Tracker</a></li>
            {{-- <li><a href="/{{ Request::segment(1) }}/tools/bikecount" class="trackclick" data-tool-type="bikecountTracker">Bike Count Tracker</a></li> --}}
            <li><a href="/{{ Request::segment(1) }}/tools/flashsale" class="trackclick" data-tool-type="flashsaleTracker">DOM Flash Sale Tracker</a></li>
            <li><a href="/{{ Request::segment(1) }}/tools/fwinitials" class="trackclick" data-tool-type="fwinitialsTracker">Footwear Initials Tracker</a></li>
        </ul>

</li>
