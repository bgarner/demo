
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

    <style type="text/css">
    
    .circle{
	    border-radius: 50%;
		width: 70px;
		height: 70px; 
		font-size: 8px;
		text-align: center;
		padding: 10px;
		margin: 5px;
		display: inline-block;
    }	

    .store-number{ font-weight: bold; font-size: 11px;}
    .sc{
    	color: #fff;
		background-image: -moz-radial-gradient(45px 45px 45deg, circle cover, #666666 0%, #111111 100%, red 95%);
		background-image: -webkit-radial-gradient(45px 45px, circle cover, #666666, #111111);
		background-image: radial-gradient(45px 45px 45deg, circle cover, #666666 0%, #111111 100%, red 95%);    	
    }
    .atmo{

    }

	

	
    </style>

</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Dax Brewster</strong>
                             </span> <span class="text-muted text-xs block">AVP - West</span> </span> </a>
                       
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
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Teams board</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>App views</a>
                        </li>
                        <li class="active">
                            <strong>Teams board</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <span class="label label-primary pull-right">NEW</span>
                            <h5>Atmosphere Praries - Rob Conway</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href=""><div class="circle sc"><span class="store-number">314</span><br /><span class="store-name">West Edmonton Mall</span></div></a>
                                <div class="circle sc"><span class="store-number">314</span><br /><span class="store-name">West Edmonton Mall</span></div>
                                <div class="circle sc"><span class="store-number">314</span><br /><span class="store-name">West Edmonton Mall</span></div>
                                <div class="circle sc"><span class="store-number">314</span><br /><span class="store-name">West Edmonton Mall</span></div>
                                <div class="circle sc"><span class="store-number">314</span><br /><span class="store-name">West Edmonton Mall</span></div>
                                <div class="circle sc"><span class="store-number">314</span><br /><span class="store-name">West Edmonton Mall</span></div>
                                <div class="circle sc"><span class="store-number">314</span><br /><span class="store-name">West Edmonton Mall</span></div>
                                <div class="circle sc"><span class="store-number">314</span><br /><span class="store-name">West Edmonton Mall</span></div>
                                <div class="circle sc"><span class="store-number">314</span><br /><span class="store-name">West Edmonton Mall</span></div>
                                <div class="circle sc"><span class="store-number">314</span><br /><span class="store-name">West Edmonton Mall</span></div>
                            </div>
                            <h4>Info about Design Team</h4>
                            <p>
                                It is a long established fact that a reader will be distracted by the readable content
                                of a page when looking at its layout. The point of using Lorem Ipsum is that it has.
                            </p>
                            <div>
                                <span>Status of current project:</span>
                                <div class="stat-percent">48%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 48%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    12
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    4th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $200,913 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Edmonton West - Grant Ranger</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href="#"><img alt="member" class="img-circle" src="img/a4.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a5.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a6.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a8.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a7.jpg"></a>
                            </div>
                            <h4>Info about Design Team</h4>
                            <p>
                                It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker.
                            </p>
                            <div>
                                <span>Status of current project:</span>
                                <div class="stat-percent">32%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 32%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    24
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    3th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $190,325 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Edmonton East - Ashley Baye</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href="#"><img alt="member" class="img-circle" src="img/a4.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a8.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a7.jpg"></a>
                            </div>
                            <h4>Info about Design Team</h4>
                            <p>
                                Uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                            </p>
                            <div>
                                <span>Status of current project:</span>
                                <div class="stat-percent">73%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 73%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    11
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    6th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $560,105 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>IT-02 - Developers Team</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href="#"><img alt="member" class="img-circle" src="img/a8.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a4.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a1.jpg"></a>
                            </div>
                            <h4>Info about Design Team</h4>
                            <p>
                                Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                            </p>
                            <div>
                                <span>Status of current project:</span>
                                <div class="stat-percent">61%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 61%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    43
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    1th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $705,913 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            <span class="label label-warning pull-right">DEADLINE</span>
                            <h5>IT-05 - Administration Team</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href="#"><img alt="member" class="img-circle" src="img/a1.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a2.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a6.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a3.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a4.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a7.jpg"></a>
                            </div>
                            <h4>Info about Design Team</h4>
                            <p>
                                Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin.
                            </p>
                            <div>
                                <span>Status of current project:</span>
                                <div class="stat-percent">14%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 14%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    8
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    7th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $40,200 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>IT-08 - Lorem ipsum Team</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href="#"><img alt="member" class="img-circle" src="img/a1.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a8.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a3.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a7.jpg"></a>
                            </div>
                            <h4>Info about Design Team</h4>
                            <p>
                                Many desktop publishing packages and web page editors now use Lorem Ipsum as their. ometimes by accident, sometimes on purpose (injected humour and the like).
                            </p>
                            <div>
                                <span>Status of current project:</span>
                                <div class="stat-percent">25%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 25%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    25
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    4th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $140,105 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">

                            <h5>IT-02 - Graphic Team</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href="#"><img alt="member" class="img-circle" src="img/a3.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a4.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a7.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a2.jpg"></a>
                            </div>
                            <h4>Info about Design Team</h4>
                            <p>
                                Very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                            </p>
                            <div>
                                <span>Status of current project:</span>
                                <div class="stat-percent">82%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 82%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    68
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    2th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $701,400 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>IT-06 - Standard  Team</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href="#"><img alt="member" class="img-circle" src="img/a1.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a2.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a4.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a7.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a8.jpg"></a>
                            </div>
                            <h4>Info about Design Team</h4>
                            <p>
                                Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                            </p>
                            <div>
                                <span>Status of current project:</span>
                                <div class="stat-percent">26%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 26%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    16
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    8th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $160,100 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>IT-09 - Modern Team</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href="#"><img alt="member" class="img-circle" src="img/a2.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a3.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a8.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a6.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="img/a7.jpg"></a>
                            </div>
                            <h4>Info about Design Team</h4>
                            <p>
                                Words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in.
                            </p>
                            <div>
                                <span>Status of current project:</span>
                                <div class="stat-percent">18%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 18%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    53
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    9th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $60,140 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
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
