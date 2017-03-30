<!DOCTYPE html>
<html>

<head>
    @section('title', 'Tasks')
    @include('site.includes.head')
</head>

<body class="fixed-navigation">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('site.includes.sidenav');
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>


        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Tasks</h2>

            </div>
            <div class="col-lg-2">

            </div>
        </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <!-- <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">

            side bar

            </div> -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 animated fadeInRight">

                    <ul class="todo-list m-t">
                        <li>
                            <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                            <span class="m-l-xs"><strong>Buy a milk</strong></span>
                            <small class="label label-primary due-date"><i class="fa fa-clock-o due-date-icon"></i>&nbsp;<span class="due-date-text">1 mins</span></small>
                            <P style="padding-left: 32px; font-size: 12px;line-height: 18px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                <ul>
                                    <li>sadasdasdasd</li>
                                    <li>sadasdasdasd</li>
                                    <li>sadasdasdasd</li>
                                    <li>sadasdasdasd</li>
                                </ul>
                        </li>
                        <li>
                            <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                            <span class="m-l-xs">Go to shop and find some products.</span>
                            <small class="label label-primary due-date"><i class="fa fa-clock-o"></i> 1 mins</small>
                        </li>
                        <li>
                            <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                            <span class="m-l-xs">Send documents to Mike</span>
                            <small class="label label-primary due-date"><i class="fa fa-clock-o"></i> 1 mins</small>
                        </li>
                        <li>

                            <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                            <span class="m-l-xs">Go to the doctor dr Smith</span>
                            <small class="label label-primary due-date"><i class="fa fa-clock-o"></i> 1 mins</small>
                        </li>
                    </ul>

            </div>
        </div>
    </div>

    @include('site.includes.footer')
    @include('site.includes.scripts')
    @include('site.includes.modal')

</body>
</html>
