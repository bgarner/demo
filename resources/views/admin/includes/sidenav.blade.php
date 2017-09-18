<ul class="nav metismenu" id="side-menu">

    <li class="nav-header">

        <div class="dropdown profile-element">

            <span class="text-muted text-xs block">
            Welcome, {{ Auth::user()->firstname }}! <a class="navbar-minimalize minimalize-styl-1 btn btn-primary pull-right" style="padding: 2px 4px; font-size: 8px;" href="#"><i class="fa fa-bars"></i> </a>

            </span>
            <br />
                 {{-- @include('admin.banner', ['banners'=>$banners]) --}}
            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="text-muted text-xs pull-left">
                    <i class="fa fa-sign-out"></i> Log out
                </span>
            </a>

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
