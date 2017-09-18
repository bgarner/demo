<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0"  style="">
<div class="navbar-header">

</div>
    <ul class="nav navbar-top-links navbar-right">

         {{-- @include('admin.banner', ['banners'=>$banners]) --}}


        <li>

            {{-- <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Log out
            </a> --}}

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>

</nav>
