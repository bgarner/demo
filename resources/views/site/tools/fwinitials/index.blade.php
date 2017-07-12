<!DOCTYPE html>
<html>

<head>
    @section('title', 'Footwear Initials Tracker')
    @include('site.includes.head')

    <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <style>
        /*.table td{ font-size: 10px; }
        .table th{ font-size: 11px; }*/
        /*#ad_min{ font-size: 24px; color: #c00; margin-left: 10px; }*/
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
                <h2>Footwear Initials Tracker</h2>
                <small class="pull-right"> Last Updated :  </small>
            </div>
        </div>


        <div class="wrapper wrapper-content printable">
                <div class="row">

                    <div class="col-lg-12 animated fadeInRight">

                        <div class="mail-box-header">


                    <div class="row">
                                <div class="col-md-12">

                    <div class="table-responsive clearfix">


                    <table class="table table-bordered table-hover fwinitialsTable" id="">
                        <thead>
                        <tr>

                            <th>Gender</th>
                            <th>LY June</th>
                            <th>TY June</th>
                            <th>LY July</th>
                            <th>TY July</th>
                            <th>LY Aug</th>
                            <th>TY Aug</th>
                            <th>LY Sept</th>
                            <th>TY Sept</th>
                            <th>LY Oct</th>
                            <th>TY Oct</th>
                            <th>LY Nov</th>
                            <th>TY Nov</th>
                            <th>LY Dec</th>
                            <th>TY Dec</th>

                            <th>LY Season 2 Total</th>
                            <th>TY Season 2 Total</th>
                            <th>data</th>

                        </tr>
                        </thead>

                        <tbody>
                        @foreach($fwinitials as $fw)

                            
                            <tr>
                            
                                <td class="expand_gender" id="{{$fw->gender}}">{{$fw->gender}}</td>
                                <td>{{$fw->ly_june}}</td>
                                <td>{{$fw->cy_june}}</td>
                                <td>{{$fw->ly_july}}</td>
                                <td>{{$fw->cy_july}}</td>
                                <td>{{$fw->ly_aug}}</td>
                                <td>{{$fw->cy_aug}}</td>
                                <td>{{$fw->ly_sept}}</td>
                                <td>{{$fw->cy_sept}}</td>
                                <td>{{$fw->ly_oct}}</td>
                                <td>{{$fw->cy_oct}}</td>
                                <td>{{$fw->ly_nov}}</td>
                                <td>{{$fw->cy_nov}}</td>
                                <td>{{$fw->ly_dec}}</td>
                                <td>{{$fw->cy_dec}}</td>
                                <td>{{$fw->last_year_total}}</td>
                                <td>{{$fw->current_year_total}}</td>
                                <td></td>

                            </tr>

                                {{--@foreach($fw->category_totals as $cat)
                                
                                <tr>
                                    <td class="expand_category" id="{{$cat->category}}">{{$cat->category}}</td>
                                    <td>{{$cat->ly_june}}</td>
                                    <td>{{$cat->cy_june}}</td>
                                    <td>{{$cat->ly_july}}</td>
                                    <td>{{$cat->cy_july}}</td>
                                    <td>{{$cat->ly_aug}}</td>
                                    <td>{{$cat->cy_aug}}</td>
                                    <td>{{$cat->ly_sept}}</td>
                                    <td>{{$cat->cy_sept}}</td>
                                    <td>{{$cat->ly_oct}}</td>
                                    <td>{{$cat->cy_oct}}</td>
                                    <td>{{$cat->ly_nov}}</td>
                                    <td>{{$cat->cy_nov}}</td>
                                    <td>{{$cat->ly_dec}}</td>
                                    <td>{{$cat->cy_dec}}</td>
                                    <td>{{$cat->last_year_total}}</td>
                                    <td>{{$cat->current_year_total}}</td>

                                </tr>
                                @endforeach --}}                           
                                
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

    @include('site.includes.footer')

    <script type="text/javascript" src="/js/plugins/fullcalendar/moment.min.js"></script>
    @include('site.includes.scripts')

    @include('site.includes.modal')
    <script type="text/javascript" src="/js/vendor/underscore-1.8.3.js"></script>
    <script src="/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <script src="/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="/js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <script>
    function format ( d ) {
        console.log(d);
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                    '<td>Full name:</td>'+
                    '<td>d.name</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Extension number:</td>'+
                    '<td>d.extn</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Extra info:</td>'+
                    '<td>And any further details here (images etc)...</td>'+
                '</tr>'+
            '</table>';
        }
        $(document).ready(function(){
            var table = $('.fwinitialsTable').DataTable({
                paging: true,
                pageLength: 50,
                responsive: true,
                "columns": [    
                   { "sortable": false, "className":'details-control'},
                   null,
                   null,
                   null,
                   null,
                   null,
                   null,
                   null,
                   null,
                   null,
                   null,
                   null,
                   null,
                   null,
                   null,
                   null,
                   null,
                   null
                 ],
            });

            $('tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
         
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                }
            } );

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
    </script>

</body>
</html>
