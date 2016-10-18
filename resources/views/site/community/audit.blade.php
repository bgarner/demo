<!DOCTYPE html>
<html>

<head>
    @section('title', 'Community Fund Audit')
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
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
            <div class="col-lg-12">
                <h2>Community Fund</h2>
            </div>
        </div>        


        <div class="wrapper wrapper-content">
                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">
                        <div class="mail-box-header">
                            <div class="row">
                                <div class="col-md-12">

                                <h1 class="pull-left">Total Donations for FY17 &nbsp;&nbsp;&nbsp; <strong>$3,568.90</strong></h1>

                                <a href="#" class="pull-right btn btn-outline btn-primary dim" data-toggle="modal" data-target="#newdonationmodal"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;New Donation</a>
                                </div>
                            </div>

                    <div class="row">
                                <div class="col-md-12">

                    <div class="table-responsive clearfix">

                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>

                    <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
                    <thead>
                    <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 157px;">Event Name</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 196px;">Date</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 176px;">Total Donation</th><th class="sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 133px;" aria-sort="descending">Donation Type</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 92px;">DM Approval</th></tr>
                    </thead>
                    <tbody>
                    
                    

                    
                    <tr class="gradeA odd" role="row">
                        <td class="">Event Title</td>
                        <td class="">20 Oct 2016</td>
                        <td class="">$200.00</td>
                        <td class="center sorting_1">Gift Card</td>
                        <td class="center"><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr><tr class="gradeA even" role="row">
                        <td class="">Event Title</td>
                        <td class="">10 Sept 2016</td>
                        <td class="">iPod</td>
                        <td class="center sorting_1">Product</td>
                        <td class="center"><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr><tr class="gradeA odd" role="row">
                        <td class="">Event Title</td>
                        <td class="">30 July 2016</td>
                        <td class="">$200.00</td>
                        <td class="center sorting_1">Gift Card</td>
                        <td class="center"><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr><tr class="gradeA even" role="row">
                        <td class="">Event Title</td>
                        <td class="">15 July 2016</td>
                        <td class="">$200.00</td>
                        <td class="center sorting_1">Gift Card</td>
                        <td class="center"><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr><tr class="gradeA odd" role="row">
                        <td class="">Event Title</td>
                        <td class="">12 July 2015</td>
                        <td class="">S60</td>
                        <td class="center sorting_1">Product</td>
                        <td class="center"><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr><tr class="gradeA even" role="row">
                        <td class="">Event Title</td>
                        <td class="">21 June 2016</td>
                        <td class="">OSX.3</td>
                        <td class="center sorting_1">Product</td>
                        <td class="center"><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr><tr class="gradeA odd" role="row">
                        <td class="">Event Title</td>
                        <td class="">10 June 2016</td>
                        <td class="">OSX.3</td>
                        <td class="center sorting_1">Product</td>
                        <td class="center"><i class="fa fa-check" aria-hidden="true"></i></td>
                    </tr><tr class="gradeA even" role="row">
                        <td class="">Event Title</td>
                        <td class="">8 May 2016</td>
                        <td class="">Nintendo DS</td>
                        <td class="center sorting_1">Product</td>
                        <td class="center">n/a</td>
                    </tr><tr class="gradeA odd" role="row">
                        <td class="">Event Title</td>
                        <td class="">8 March 2016</td>
                        <td class="">Win XP SP2+</td>
                        <td class="center sorting_1">Product</td>
                        <td class="center">n/a</td>
                    </tr><tr class="gradeA even" role="row">
                        <td class="">Event Title</td>
                        <td class="">18 February 2016</td>
                        <td class="">Win XP</td>
                        <td class="center sorting_1">Product</td>
                        <td class="center">n/a</td>
                    </tr></tbody>

                    </table><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="DataTables_Table_0_previous"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="DataTables_Table_0_next"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div>
                        </div>

                        <div class="col-md-12">

                                    <h3>Instructions</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>


                                  
                                </div>


                            </div>

                        </div>

                    </div>
                </div>
        </div>



    @include('site.includes.footer')       

    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
    @include('site.includes.scripts')
 
    <script src="/js/plugins/iCheck/icheck.min.js"></script>
 
    @include('site.includes.modal')

</body>
</html> 