<ul class="nav metismenu" id="side-menu">

    <li class="nav-header">

        <div class="dropdown profile-element">

            <span class="text-xs block" style="padding-bottom: 10px; color: #DFE4ED;">
            Welcome, {{ Auth::user()->firstname }}!
            <a class="navbar-minimalize minimalize-styl-1 btn btn-primary pull-right" style="padding: 2px 4px; font-size: 8px;" href="#"><i class="fa fa-bars"></i> </a>
            </span>
            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="text-xs">
                    <i class="fa fa-sign-out"></i> Log out
                </span>
            </a>

            <br />
           @if(Auth::user()->group_id != 3) //hide the banner selector for the forms group
            <ul class="banner-selector-menu metismenu text-xs">
                <span style="font-size: 10px;" class="text-muted">Current Banner</span>
                <li>
                    <a href="#" class="current-banner-anchor">
                        <i class="fa fa-flag banner-icon" aria-hidden="true"></i>&nbsp;&nbsp;<span class="text-xs current-banner"></span><span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        @foreach($banners as $banner)
                            <li> <a class="banner-switch text-xs" data-banner-id ={{$banner->id}}> {{$banner->name}} </a>  </li>
                        @endforeach
                    </ul>
                </li>
            </ul>   
            @endif




            {{-- <li class="dropdown">
            	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Banner <span class="caret"></span></a>
            	<ul class="dropdown-menu">
            		@foreach($banners as $banner)
            			<li> <a class="banner-switch" data-banner-id ={{$banner->id}}> {{$banner->name}} </a>  </li>
            		@endforeach
            	</ul>
            </li> --}}




            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>

        </div>

        <div class="logo-element">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#" style="margin: 1px 5px 10px 15px;"><i class="fa fa-bars"></i></a>
            <br />
        </div>

    </li>


    @foreach($roleComponents as $component)

        <?php
        $component = preg_replace('/\s+/', '', $component);
        $partialName = 'admin.includes.sidenav-partials.' . $component;
         ?>
        @include($partialName)

    @endforeach


</ul>
