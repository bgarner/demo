<ul class="nav metismenu" id="side-menu">
    <a href="/{{ Request::segment(1) }}">
    <li class="nav-header">
        <!-- <div class="logo-element">

        </div> -->
    </li>
    </a>
    
    @foreach($components as $component)

        <?php 
        $component_name = preg_replace('/\s+/', '', $component['component_name']);
        $partialName = 'site.includes.sidenav-partials.' . $component_name; 
         ?>
        @include($partialName, [ 'component_label' => $component['component_label']])
        
    @endforeach

   
</ul>
