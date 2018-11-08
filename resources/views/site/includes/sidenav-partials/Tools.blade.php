@if (Request::segment(2) == 'tools')
<li class="active">
@else
<li>
@endif

    <a href="#"><i class="fa fa-wrench" aria-hidden="true"></i> <span class="nav-label">{{__($component_label)}}</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse" style="height: 0px;">
            
            {{-- <li><a href="/{{ Request::segment(1) }}/tools/bikecount" class="trackclick" data-tool-type="bikecountTracker">Bike Count Tracker</a></li> --}}
            @foreach($subcomponents as $sc)

            @if(isset($sc['config']) && $sc['config']->state == 'on')
                <?php 
                    $subcomponent_name = preg_replace('/\s+/', '', $sc['subcomponent_name']);
                    $partialName = 'site.includes.sidenav-partials.subcomponents.' . $subcomponent_name;
                ?>
                
                @include($partialName)
            @endif
            @endforeach
            
        </ul>
    
</li>
