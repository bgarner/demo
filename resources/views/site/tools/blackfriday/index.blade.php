<!DOCTYPE html>
<html>

<head>
    @section('title', 'Door-Crasher Tracker')
    @include('site.includes.head')

 {{--    <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet"> --}}
    <style>
        .table td{ font-size: 11px; }
        .table th{ font-size: 11px; }
        #ad_min{ font-size: 24px; color: #c00; margin-left: 10px; }
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
                <h2>Door-Crasher Tracker</h2>
            </div>
        </div>        


        <div class="wrapper wrapper-content">
                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">

                        <div class="mail-box-header">


                    <div class="row">
                                <div class="col-md-12">


                            <label>Flyer Page</label>

                            <select id="flyerPageSelect">
                                <option></option>
                                @foreach($pages as $page)
                                    <option value="{{ $page->flyer_page }}">{{ $page->flyer_page }}</option>
                                @endforeach            
                            </select>


                            <label>Ad Box</label>
                            <select id="adBoxSelect"></select>
                    
                            <div class="pull-right" style="padding-right: 20px;">
                            <label>Ad Min</label>
                            <span id="ad_min"></span>
                            </div>
                            <hr />
                    <div class="table-responsive clearfix">


                    <table class="table table-striped table-bordered table-hover dataTable" id="DataTables_Table_0" style="display: none;" aria-describedby="DataTables_Table_0_info" role="grid">


                    </table>

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
    <script src="/js/custom/site/tools/flyerPages.js"></script>

    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
    
                responsive: true

            });

        });
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });    
    </script>

</body>
</html> 