<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="ScreenOrientation" content="autoRotate:disabled">
    @section('title', 'DOM Nodes')
    @include('site.includes.head')

 {{--    <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet"> --}}
    <style>

        table{ width: 100% !important; }
        .table td{ font-size: 11px; }
        .table th{ font-size: 11px; } 

        .loading{
            position: fixed; /* Sit on top of the page content */
            width: 100%; /* Full width (cover the whole page) */
            height: 100%; /* Full height (cover the whole page) */
            top: 0; 
            left: 0px;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.8); /* Black background with opacity */
            z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer;

        }
        .loading h1{
           position: relative;
            top: 40%;
            text-align: center;
            color: #fff;
        }
        .loadingimg{
            position: relative;
            top: 50%;
        }

        .dataTables_length{
            display: none;
        }

        #DataTables_Table_0_wrapper .row:first-child div.col-sm-6:first-child  {
            width: 0px !important
        }

        #DataTables_Table_0_wrapper .row:first-child div.col-sm-6:nth-child(2n)  {
            
            width: 100% !important
            
        }        
        .dataTables_filter{
            width: 100%;
            
            margin: 0 auto;
        }
        .dataTables_filter label{
            font-size: 0px;
        }
        input[type="search"]{
            /*
            width: 800px;
            border: thin solid lime;
            margin: 0 auto;
            */
            text-align: center;
            height: 100%;
            padding: 10px;
            width: 80% !important;
            display:none;
        }
        .panel-body, .table-responsive{
            border: none !important;
        }
        .collapse-link{
            display: none;
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
        <div class="loading"><h1>Loading DOM Nodes...<br /><img src="/images/ajax-loader.gif" class="loadingimg" /></h1></div>
        <div class="row border-bottom">
            @include('site.includes.topbar')
        </div>


<div class="wrapper wrapper-content  animated fadeInRight printable">

            <div class="row">
                <div class="col-lg-12">


<div class="ibox">
    <div class="ibox-title">
        <h2>UPC Dirty Node Scanner</h2>
        <div class="ibox-tools">
            <!-- <a class="btn btn-xs" id="videoReportModal">View Report by Date</a> -->
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>

    </div>

    <div class="ibox-content">

        <div class="tabs-container">
        
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table dirtynodestable" id="">
                                    <thead>
                                    <tr>
                                        <th style="display: none;">ID</th>
                                        <th></th>
                                        <th>UPC</th>
      

                                    </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($data as $d)
                                        <tr id="nodeID_{{ $d->id }}">
                                            <td style="display: none;">{{ $d->id }}</td>
                                            <td>
                                                <input type="button" class="cleannodebutton btn btn-sm btn-primary" value="Clean"
                                                    data-nodeid="{{ $d->id }}"
                                                    data-upc="{{ $d->upccode }}"
                                                    data-style="{{ $d->stylecode }}"
                                                    data-desc="{{ $d->styledesc }}"
                                                    data-color="{{ $d->color }}"
                                                    data-size="{{ $d->sizename }}"
                                                    data-start="{{ $d->startdate }}"
                                                    data-qty="{{ $d->quantity }}"
                                                    data-price="{{ $d->selling_price }}"
                                                    data-dept="{{ $d->department }}"
                                                    data-subdept="{{ $d->sub_department }}"
                                                >
                                            </td>
                                            <td>{{ $d->upccode }}</td>
                                            
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
</div>
        </div>
    </div>
</div>

    @include('site.includes.footer')

    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
    @include('site.includes.scripts')

    @include('site.includes.modal')
    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script src="/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <script src="/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="/js/custom/site/tools/dirtyNodes-pdt.js?<?=time();?>"></script>
    <script src="/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script>
        $(document).ready(function(){
            //$('<div class="loading">Loading</div>').appendTo('body');

            //document.getElementById("searchfield").focus();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.dirtynodestable').DataTable({
                paging: true,
                pageLength: 50,
                "ordering": false,
                responsive: true,                
                "initComplete": function( settings, json ) {
                     $('div.loading').remove();
                     $('#DataTables_Table_0_filter input').focus();
                     $( "#DataTables_Table_0_filter input" ).after( "<button type='button' value='X' style='margin-left: 5px;' class='clearupc btn btn-sm btn-danger'>X</button>" );
                }
            });
           
            $(".clearupc").click(function() {
                $("#DataTables_Table_0_filter input").val('');
                $('#DataTables_Table_0_filter input').focus();
            });
            
        });

        var field = $('#DataTables_Table_0_filter input');
        field.setAttribute('type', 'text');
        document.body.appendChild(field);

        setTimeout(function() {
            field.focus();
            setTimeout(function() {
                field.setAttribute('style', 'display:none;');
            }, 50);
        }, 50);

        

    </script>

</body>
</html>
