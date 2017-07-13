<!DOCTYPE html>
<html>

<head>
    @section('title', 'Footwear Initials Tracker')
    @include('site.includes.head')

    <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <style>
        .fa-plus-circle {
            color:#1ab394;
        }
        .fa-minus-circle {
            color:#ed5565;
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


                    <table class="table table-bordered table-hover fwinitialsTable">
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
                        @foreach($fwinitials as $key=>$fw)
                          
                            <tr>                            
                                <td class="expand_gender" id="gender_{{$key}}"><i class="fa fa-plus-circle"></i> {{$fw->gender}}</td>
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
                                <td>{{$fw->category_totals}}</td>

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

    @include('site.includes.footer')

    @include('site.includes.scripts')

    @include('site.includes.modal')
    <script src="/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
    <script src="/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="/js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <script>
    function formatCategoryTable ( row , rowId) {
            d = row.data();
            var nestedData = JSON.parse(d[17]);
            var returnString = '<table class="table categoryTable" id="categoryTable_'+rowId+'">'+
                                '<thead>'+
                                    '<th>Category</th>'+
                                    '<th>LY June</th>'+
                                    '<th>TY June</th>'+
                                    '<th>LY July</th>'+
                                    '<th>TY July</th>'+
                                    '<th>LY Aug</th>'+
                                    '<th>TY Aug</th>'+
                                    '<th>LY Sept</th>'+
                                    '<th>TY Sept</th>'+
                                    '<th>LY Oct</th>'+
                                    '<th>TY Oct</th>'+
                                    '<th>LY Nov</th>'+
                                    '<th>TY Nov</th>'+
                                    '<th>LY Dec</th>'+
                                    '<th>TY Dec</th>'+

                                    '<th>LY Season 2 Total</th>'+
                                    '<th>TY Season 2 Total</th>'+
                                    '<th>data</th>'+
                                '</thead>'+
                                '<tbody>';
            // returnString = '';

            $(nestedData).each(function(index, value){
                returnString += '<tr>'+
                                    '<td class="expand_category" id="'+rowId+'_category_'+index+'" data-table-id="categoryTable_'+rowId+'">'+
                                        '<i class="fa fa-plus-circle"></i> '+value.category+'</td>'+
                                    '<td>'+ value.ly_june+'</td>'+
                                    '<td>'+ value.cy_june+'</td>'+
                                    '<td>'+ value.ly_july+'</td>'+
                                    '<td>'+ value.cy_july+'</td>'+
                                    '<td>'+ value.ly_aug+'</td>'+
                                    '<td>'+ value.cy_aug+'</td>'+
                                    '<td>'+ value.ly_sept+'</td>'+
                                    '<td>'+ value.cy_sept+'</td>'+
                                    '<td>'+ value.ly_oct+'</td>'+
                                    '<td>'+ value.cy_oct+'</td>'+
                                    '<td>'+ value.ly_nov+'</td>'+
                                    '<td>'+ value.cy_nov+'</td>'+
                                    '<td>'+ value.ly_dec+'</td>'+
                                    '<td>'+ value.cy_dec+'</td>'+
                                    '<td>'+ value.last_year_total+'</td>'+
                                    '<td>'+ value.current_year_total+'</td>'+
                                    '<td>'+ value.brand_totals+'</td>'+

                                '</tr>';
                                
            });
            returnString += '</tbody></table>';
            return returnString;
            
        }


        function formatBrandTable ( row , rowId) {
            d = row.data();
            var nestedData = JSON.parse(d[17]);
            var returnString = '<table class="table brandTable" id="brandTable_'+rowId+'">'+
                                '<thead>'+
                                    '<th>Brand</th>'+
                                    '<th>LY June</th>'+
                                    '<th>TY June</th>'+
                                    '<th>LY July</th>'+
                                    '<th>TY July</th>'+
                                    '<th>LY Aug</th>'+
                                    '<th>TY Aug</th>'+
                                    '<th>LY Sept</th>'+
                                    '<th>TY Sept</th>'+
                                    '<th>LY Oct</th>'+
                                    '<th>TY Oct</th>'+
                                    '<th>LY Nov</th>'+
                                    '<th>TY Nov</th>'+
                                    '<th>LY Dec</th>'+
                                    '<th>TY Dec</th>'+

                                    '<th>LY Season 2 Total</th>'+
                                    '<th>TY Season 2 Total</th>'+
                                '</thead>'+
                                '<tbody>';
            // returnString = '';

            $(nestedData).each(function(index, value){
                returnString += '<tr>'+
                                    '<td id="'+rowId+'_brand_'+index+'" data-category-id="'+ rowId +'">'+value.brand+'</td>'+
                                    '<td>'+ value.ly_june+'</td>'+
                                    '<td>'+ value.cy_june+'</td>'+
                                    '<td>'+ value.ly_july+'</td>'+
                                    '<td>'+ value.cy_july+'</td>'+
                                    '<td>'+ value.ly_aug+'</td>'+
                                    '<td>'+ value.cy_aug+'</td>'+
                                    '<td>'+ value.ly_sept+'</td>'+
                                    '<td>'+ value.cy_sept+'</td>'+
                                    '<td>'+ value.ly_oct+'</td>'+
                                    '<td>'+ value.cy_oct+'</td>'+
                                    '<td>'+ value.ly_nov+'</td>'+
                                    '<td>'+ value.cy_nov+'</td>'+
                                    '<td>'+ value.ly_dec+'</td>'+
                                    '<td>'+ value.cy_dec+'</td>'+
                                    '<td>'+ value.last_year_total+'</td>'+
                                    '<td>'+ value.current_year_total+'</td>'+

                                '</tr>';
                                
            });
            returnString += '</tbody></table>';
            return returnString;
            
        }



        $(document).ready(function(){
            var table = $('.fwinitialsTable').DataTable({
                
                "info"   :false,
                "bPaginate": false,
                "paging":   false,
                "columns": [    
                   { "sortable": false, "className":'details-control'},
                   null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null
                 ],
                 "searching": false
            });
            table.column( 17 ).visible( false );

            $('tbody').on('click', 'td.details-control', function () {

                var tr = $(this).closest('tr');
                var rowId = $(tr).find(".expand_gender").attr('id');
                var row = table.row( tr );
         
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                    tr.find("i.fa").toggleClass("fa-minus-circle").toggleClass('fa-plus-circle');
                    
                }
                else {
                    // Open this row
                    row.child(formatCategoryTable(row, rowId)).show();
                    
                    var categoryTable = $("#categoryTable_"+rowId).DataTable({
                        "bPaginate": false,
                        "paging":   false,
                        "ordering": false,
                        "info":     false,
                        "searching": false
                    });
                    // push the datatable instance to be used later to view the brands
                    $("body").data( "categoryTable_"+rowId , categoryTable);
                    categoryTable.column( 17 ).visible( false );
                    tr.addClass('shown');
                    tr.find("i.fa").toggleClass("fa-plus-circle").toggleClass('fa-minus-circle');
                }
            } );

            $("body").on('click', ".expand_category" , function(){
                var tr = $(this).parent();
                var parentTableId = $(this).attr('data-table-id');
                var rowId  = $(this).attr('id');
                var row = $( "body" ).data(parentTableId).row( tr );
         
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.find("i.fa").toggleClass("fa-plus-circle").toggleClass('fa-minus-circle');
                    tr.removeClass('shown');
                    
                }
                else {
                    // Open this row
                    row.child(formatBrandTable(row, rowId)).show();
                    
                    var categoryTable = $("#brandTable_"+rowId).DataTable({
                        "bPaginate": false,
                        "paging":   false,
                        "ordering": false,
                        "info":     false,
                        "searching": false
                    });
                    $("body").data( rowId , categoryTable);
                    tr.find("i.fa").toggleClass("fa-plus-circle").toggleClass('fa-minus-circle');
                    tr.addClass('shown');
                }
            });

        });
        
    </script>

</body>
</html>
