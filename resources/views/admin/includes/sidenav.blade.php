<ul class="nav metismenu" id="side-menu">
    <li class="nav-header">
        <div class="dropdown profile-element"> 
            {{-- <span>
                <img alt="image" class="img-circle" src="/wireframes/img/profile_small.jpg" />
            </span> --}}
            <a data-toggle="dropdown" class="" href="#">
                <span class="clear">
                    <span class="block m-t-xs">
                    <center>
                    <img src="/images/fgl.png" />
                    </center>
                    </span>

                  <span class="text-muted text-xs block"></span><br />
                 <a href="profile"><span class="text-muted text-xs"></span></a>  
                 <!-- <a href="/admin/logout"><span class="text-muted text-xs pull-right"> <i class="fa fa-sign-out"></i> Log out</span></a>  -->
        </div>

        <div class="logo-element">
            F
        </div>
    </li>

    @foreach($groupComponents as $component)

        <?php 
        $component = preg_replace('/\s+/', '', $component);
        $partialName = 'admin.includes.sidenav-partials.' . $component; 
         ?>
        @include($partialName)
        
    @endforeach


</ul>
