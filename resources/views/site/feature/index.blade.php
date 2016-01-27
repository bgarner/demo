<!DOCTYPE html>
<html>

<head>
    @section('title', 'Feature: ' . $feature->title)
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    @include('site.includes.head')
    
</head> 

<body class="fixed-navigation">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
              @include('site.includes.sidenav')
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg clearfix" style="background-size: 100%; background-image: url('/images/featured-backgrounds/{{ $feature->background_image }}'); background-color: #f3f3f4; background-position: top left; background-repeat: no-repeat; float: left; clear: both;">
            <div class="row border-bottom">
                @include('site.includes.topbar')
            </div>



            <div class="wrapper wrapper-content" style="position: relative; top: 120px;">


                <div class="row">
                    <div class="col-lg-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h2>Featured Content</h2>
                            </div>
                      
                            <div class="ibox-content clearfix">


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h2>Quick Links</h2>
                                    </div>
                              
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
                                                <tr>
                                                    
                                                    <td><a data-toggle="tab" href="#contact-1" class="client-link"><i class="fa fa-external-link"></i>  Visit The North Face Website</a></td>
                                                    
                                                </tr>
                                                <tr>
                                                    
                                                    <td><a data-toggle="tab" href="#contact-1" class="client-link"><i class="fa fa-external-link"></i>  Visit the Nike University</a></td>
                                                </tr>
                                                <tr>
                                                    
                                                    <td><a data-toggle="tab" href="#contact-1" class="client-link"><i class="fa fa-file-pdf-o"></i>  OH&amp;S</a></td>
                                                </tr>
                                                <tr>
                                                    
                                                   <td><a data-toggle="tab" href="#contact-1" class="client-link"><i class="fa fa-file-pdf-o"></i>  Store Repairs</a></td>
                                                </tr>
                                                <tr>
                                                    
                                                    <td><a data-toggle="tab" href="#contact-1" class="client-link"><i class="fa fa-external-link"></i>  Corporate Web Portal</a></td>
                                                </tr>
                                                <tr>
                                                    
                                                    <td><a data-toggle="tab" href="#contact-1" class="client-link"><i class="fa fa-calendar"></i>  Week 46 Workload Calendar</a></td>
                                                </tr>



                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>                              
                            </div>

                            <div class="col-lg-6">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h2>Latest Communications</h2>
                                    </div>
                              
<div class="ibox-content">
                                <div class="feed-activity-list">

                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">1m ago</small>
                                            <strong>Get Ready for Hockey Plus</strong>
                                            <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</div>
                                            <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                                        </div>
                                    </div>

                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">2m ago</small>
                                            <strong>Back to School Primer</strong>
                                            <div>There are many variations of passages of Lorem Ipsum available</div>
                                            <small class="text-muted">Today 2:23 pm - 11.06.2014</small>
                                        </div>
                                    </div>

                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Information on New Accessories Fixtures</strong>
                                            <div>Contrary to popular belief, Lorem Ipsum</div>
                                            <small class="text-muted">Today 1:00 pm - 08.06.2014</small>
                                        </div>
                                    </div>

                                    <div class="feed-element">
                                        <div>
                                            <small class="pull-right">5m ago</small>
                                            <strong>Jumpstart Update for March 2016</strong>
                                            <div>The generated Lorem Ipsum is therefore </div>
                                            <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                        </div>
                                    </div>




                                </div>
                            </div>
                                </div>                              
                            </div>                            
                        </div>


                      
                    </div>

                    <div class="col-lg-4">

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h2>Latest Updates</h2>
                                    </div>
<div class="ibox-content">

                                        <div>
                                            <div class="feed-activity-list">

                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">5m ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">Today 5:60 pm - 12.06.2014</small>

                                                    </div>
                                                </div>

                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">2h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">Today 2:10 pm - 12.06.2014</small>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">2h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">2 days ago at 8:30am</small>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">5h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>

                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">2h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">Yesterday 5:20 pm - 12.06.2014</small>
                                                        
                                                        
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">23h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                                    </div>
                                                </div>
                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                       <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">46h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                                    </div>
                                                </div>

                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">46h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                                    </div>
                                                </div>

                                                <div class="feed-element">
                                                    <a href="#" class="pull-left">
                                                        <h1><i class="fa fa-file-pdf-o"></i></h1>
                                                    </a>
                                                    <div class="media-body ">
                                                        <small class="pull-right">46h ago</small>
                                                        <strong>Place Holder File name</strong> was added to <strong>Folder Name</strong>. <br>
                                                        <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                                    </div>
                                                </div>
                                            </div>

                                           {{--  <button class="btn btn-primary btn-block m-t"><i class="fa fa-arrow-down"></i> Show More</button> --}}

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>
           

                <br class="clearfix" />
            </div>





        </div>
    </div>

    @include('site.includes.footer')       
    @include('site.includes.scripts')
    @include('site.includes.bugreport')

</body>
</html> 