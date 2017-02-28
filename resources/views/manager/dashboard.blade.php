
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>

    <title> @yield('title') </title>

    <link rel="stylesheet" type="text/css" media="all" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="/fonts/font-awesome/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" media="print" href="/css/print.css">

    <link rel="stylesheet" type="text/css" media="screen" href="/css/plugins/sweetalert/sweetalert.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/plugins/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" type="text/css" media="print" href="/css/plugins/fullcalendar/fullcalendar.print.css">

    <link rel="stylesheet" type="text/css" media="screen" href="/css/animate.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/app.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/css/skins/manager/skin.css">

    <style type="text/css">

    .circle{
	    border-radius: 50%;
		width: 42px;
		height: 42px;
		font-size: 8px;
		text-align: center;
		padding: 2px;
		margin: 3px;
		display: inline-block;
    }

    .profile-circle{

    }

    .store-number{ font-weight: normal; font-size: 13px; position: relative; top: 8px;}
    .sc{
    	color: #fff;
		background-image: -moz-radial-gradient(45px 45px 45deg, circle cover, #666666 0%, #111111 100%, red 95%);
		background-image: -webkit-radial-gradient(45px 45px, circle cover, #666666, #111111);
		background-image: radial-gradient(45px 45px 45deg, circle cover, #666666 0%, #111111 100%, red 95%);
    }
    .profile-circle{
        color: #ccc;
        background-color: #fafafa;
        letter-spacing: -6px;
        font-size: 50px;
        height: 80px;
        width: 80px;
        padding: 5px;
        margin: 5px;
    }
    .atmo{

    }

    .profile-name{
        color: #fafafa;
    }
    #nav-header-content{
        /*border: thin solid lime;*/
    }
    .nav-header{

    }

    #nav-header-content a{
        border: none !important;
        background: none !important;
    }
    #nav-header-content a:hover{
        color: #fff;
    }




    </style>

</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div id="nav-header-content">
                        <div class="circle profile-circle">
                            TP
                        </div>

                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold profile-name">Test Person</strong>
                            </span>
                            <span class="text-muted text-xs block">AVP - West</span>
                            <a href="/manager" class="no-style">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </span>
                    </div>

                </li>

                <li>
                    <a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">Thing 1</span></a>
                </li>

                <li>
                    <a href="#"><i class="fa fa-pie-chart"></i> <span class="nav-label">Thing 2</span>  </a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-flask"></i> <span class="nav-label">Thing 3</span></a>
                </li>

                <li>
                    <a href="#"><i class="fa fa-laptop"></i> <span class="nav-label">Thing 4</span></a>
                </li>


                <li>
                    <a href="#"><i class="fa fa-magic"></i> <span class="nav-label">Thing 5 </span><span class="label label-info pull-right">62</span></a>
                </li>

            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

        </div>
            <ul class="nav navbar-top-links navbar-right">


                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="/manager">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>


        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">


                @foreach($region->districts as $district)
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            {{-- <span class="label label-primary pull-right">NEW</span> --}}
                            <h5>{{ $district->name }} - {{ $district->dm_name }}</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                            @foreach($district->stores as $store)
                                <a href="/manager/store/{{ $store->store_number }}"><div class="circle sc"><span class="store-number">{{ $store->store_number }}</span></div></a>
                            @endforeach

                            </div>
{{--                             <h4>Info about Design Team</h4>
                            <p>
                                It is a long established fact that a reader will be distracted by the readable content
                                of a page when looking at its layout. The point of using Lorem Ipsum is that it has.
                            </p> --}}
                            <div>
                                <span>Comp Sales YTD:</span>
                                <div class="stat-percent">89%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 89%;" class="progress-bar"></div>
                                </div>
                                <span>Budget Sales YTD:</span>
                                <div class="stat-percent">86%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 86%;" class="progress-bar"></div>
                                </div>
                                <span>Payroll YTD:</span>
                                <div class="stat-percent">48%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 48%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-3">
                                    <div class="font-bold">PROJECTS</div>
                                    12
                                </div>
                                <div class="col-sm-3">
                                    <div class="font-bold">RANKING</div>
                                    4th
                                </div>
                                <div class="col-sm-6 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $200,913 <i class="fa fa-level-up text-navy"></i> <small>(+8%)</small>
                                </div>
                            </div>

                        </div>
                    </div>
                    </div>
                    @endforeach


            </div>


        </div>
        <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

</body>

</html>
