<!DOCTYPE html>
<html>

<head>
    @section('title', 'Bike Count Tracker')
    @include('site.includes.head')

 {{--    <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet"> --}}
    <style>
        .table td{ font-size: 10px; }
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
                <h2>Bike Count Tracker</h2>
            </div>
        </div>


        <div class="wrapper wrapper-content printable">
                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">

                        <div class="mail-box-header">


                    <div class="row">
                                <div class="col-md-12">

                    <div class="table-responsive clearfix">

                        <p>Last Updated: Friday, December 23, 2016 - 9:25 AM MST</p>

                    <table class="table table-bordered table-hover biketable" id="">
                        <thead>
                        <tr>


                            <th>Class</th>

                            <th>Brand</th>

                            <th>Style</th>

                            <th>Style Name</th>

                            <th>Colour</th>

                            <th>Size</th>

                            <th>On Hand</th>

                            <th>In Transit</th>



                        </tr>
                        </thead>

                        <tbody>
                        {{-- @foreach($data as $d)

                            @if($d->newbox == 1)

                            @if($d->box_total > 0)
                            <tr>
                                <td colspan="11" style="background-color: #eee;">
                                    <span class="pull-right">Total On Hand/In Transit for this box: &nbsp;&nbsp;<strong>{{ $d->box_total }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                </td>
                            </tr>
                            @endif

                            <tr>
                                <td colspan="11" style="background: yellow;">
                                <span class="pull-right">
                                    <strong>Flyer Page:</strong> {{ $d->flyer_page }} &nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong>Ad Box:</strong> {{$d->ad_box}} &nbsp;&nbsp;&nbsp;&nbsp;
                                    <strong>MIN:</strong> {{$d->ad_min}}
                                </span>

                                </td>
                            </tr>
                            @endif

                            <tr>
                                <td>{{ $d->dpt_name }}</td>
                                <td>{{ $d->sdpt_name }}</td>
                                <td>{{ $d->cls_name }}</td>
                                <td>{{ $d->style_number }}</td>
                                <td>{{ $d->style_name }}</td>
                                <td>{{ $d->clr_name }}</td>
                                <td>{{ $d->oh_qty }}</td>
                                <td>{{ $d->it_qty }}</td>
                                <td>{{ $d->total_onhand_intransit }}</td>


                            </tr>
                        @endforeach --}}

                        </tbody>
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
            $('.biketable').DataTable({
                paging: false,
                responsive: true,
                // "order": [[ 8, 'asc' ], [ 9, 'asc' ]]
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
