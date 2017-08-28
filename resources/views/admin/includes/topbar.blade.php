<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0"  style="">
<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
<div class="navbar-header">

</div>
    <ul class="nav navbar-top-links navbar-right">

         @include('admin.banner', ['banners'=>$banners])
        {{-- <li>
            <span class="m-r-sm text-muted welcome-message"></span>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope"></i>  <span class="label label-warning">5</span>
            </a>
            <ul class="dropdown-menu dropdown-messages">
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
            </ul>
        </li>

        <li>
            <a class="right-sidebar-toggle">
                <i class="fa fa-tasks"></i>
            </a>
        </li> --}}

        <li>
            
            <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Log out
            </a>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>

</nav>
