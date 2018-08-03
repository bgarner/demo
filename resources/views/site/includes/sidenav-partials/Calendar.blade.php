@if (Request::segment(2) == 'calendar')
<li class="active">
@else
<li>
@endif
    <a href="/{{ Request::segment(1) }}/calendar"><i class="fa fa-calendar"></i> <span class="nav-label">{{__($component_label)}}</span><span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse" style="height: 0px;">
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