<!DOCTYPE html>
<html>

<head>
    @section('title', $trackerTitle )
    @include('site.includes.head')

    <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <style>
        .fa-plus-circle {
            color:#1ab394;
        }
        .fa-minus-circle {
            color:#ed5565;
        }
        .viewStyle, .expand_brand, .expand_category, .expand_subdept{
            cursor: pointer;
        }

    </style>
</head>

<body class="fixed-navigation">
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
          @include('site.includes.sidenav')
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>


       <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>{{$trackerTitle}}</h2>
                <small class="pull-right"> Last Updated :  </small>
            </div>
            <div id="rolling-months" class="hidden"  data-months="{{json_encode($fwInitialsMonths)}}"></div>
        </div>


        <div class="wrapper wrapper-content printable">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight">
                    <div class="mail-box-header">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive clearfix">
                                    <table class="table table-bordered table-hover fwinitialsTable">
                                        <thead>
                                        <tr>
                                            <th>Department</th>
                                            <th>LY {{$fwInitialsMonths->month1}}</th>
                                            <th>TY {{$fwInitialsMonths->month1}}</th>
                                            <th>LY {{$fwInitialsMonths->month2}}</th>
                                            <th>TY {{$fwInitialsMonths->month2}}</th>
                                            <th>LY {{$fwInitialsMonths->month3}}</th>
                                            <th>TY {{$fwInitialsMonths->month3}}</th>
                                            <th>LY Season Total</th>
                                            <th>TY Season Total</th>
                                            <th>data</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($fwinitials as $key=>$fw)
                                          
                                            <tr>                            
                                                <td class="expand_dept" id="dept_{{$key}}"><i class="fa fa-plus-circle"></i> {{$fw->department}}</td>
                                                <td>{{$fw->ly_month1}}</td>
                                                <td>{{$fw->cy_month1}}</td>
                                                <td>{{$fw->ly_month2}}</td>
                                                <td>{{$fw->cy_month2}}</td>
                                                <td>{{$fw->ly_month3}}</td>
                                                <td>{{$fw->cy_month3}}</td>
                                                <td>{{$fw->last_year_total}}</td>
                                                <td>{{$fw->current_year_total}}</td>
                                                <td>{{$fw->subdept_totals}}</td>

                                            </tr>                    
                                                
                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <div id="view-style-modal" class="modal inmodal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">

                        <img class="styleImage" src="" alt="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

    @include('site.includes.footer')

    @include('site.includes.scripts')

    @include('site.includes.modal')
    <script src="/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <script src="/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="/js/custom/site/tools/sginitials.js"></script>

    <script>
        var table = $('.fwinitialsTable').DataTable({
        
            "info"   :false,
            "bPaginate": false,
            "paging":   false,
            "columns": [    
               { "className":'expand-dept'},
               null,null,null,null,null,null,null,null,null
             ],
             "searching": false
        });
        table.column(9).visible( false );
        
    </script>

</body>
</html>
