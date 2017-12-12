function formatCategoryTable ( row , rowId) {
    d = row.data();
    var nestedData = JSON.parse(d[9]);

    var months  = ($("#rolling-months").data('months'));
    var returnString = '<table class="table categoryTable" id="categoryTable_'+rowId+'">'+
                        '<thead>'+
                            '<th>Category</th>'+
                            '<th>LY '+ months.month1 +'</th>'+
                            '<th>TY '+ months.month1 +'</th>'+
                            '<th>LY '+ months.month2 +'</th>'+
                            '<th>TY '+ months.month2 +'</th>'+
                            '<th>LY '+ months.month3 +'</th>'+
                            '<th>TY '+ months.month3 +'</th>'+
                            '<th>LY Season Total</th>'+
                            '<th>TY Season Total</th>'+
                            '<th>data</th>'+
                        '</thead>'+
                        '<tbody>';
    // returnString = '';

    $(nestedData).each(function(index, value){
        returnString += '<tr>'+
                            '<td class="expand_category" id="'+rowId+'_category_'+index+'" data-table-id="categoryTable_'+rowId+'">'+
                                '<i class="fa fa-plus-circle"></i> '+value.category+'</td>'+
                            '<td>'+ value.ly_month1+'</td>'+
                            '<td>'+ value.cy_month1+'</td>'+
                            '<td>'+ value.ly_month2+'</td>'+
                            '<td>'+ value.cy_month2+'</td>'+
                            '<td>'+ value.ly_month3+'</td>'+
                            '<td>'+ value.cy_month3+'</td>'+
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
    var nestedData = JSON.parse(d[9]);
    var months  = ($("#rolling-months").data('months'));
    var returnString = '<table class="table brandTable" id="brandTable_'+rowId+'">'+
                        '<thead>'+
                            '<th>Brand</th>'+
                            '<th>LY '+ months.month1 +'</th>'+
                            '<th>TY '+ months.month1 +'</th>'+
                            '<th>LY '+ months.month2 +'</th>'+
                            '<th>TY '+ months.month2 +'</th>'+
                            '<th>LY '+ months.month3 +'</th>'+
                            '<th>TY '+ months.month3 +'</th>'+
                            '<th>LY Season Total</th>'+
                            '<th>TY Season Total</th>'+
                            '<th>data</th>'+
                        '</thead>'+
                        '<tbody>';
    // returnString = '';

    $(nestedData).each(function(index, value){

        returnString += '<tr>'+
                            '<td class="expand_brand" data-category-id="'+ rowId +'" id="'+rowId+'_brand_'+index+'" data-table-id="brandTable_'+rowId+'">'+
                                '<i class="fa fa-plus-circle"></i> '+value.brand+'</td>'+
                            '<td>'+ value.ly_month1+'</td>'+
                            '<td>'+ value.cy_month1+'</td>'+
                            '<td>'+ value.ly_month2+'</td>'+
                            '<td>'+ value.cy_month2+'</td>'+
                            '<td>'+ value.ly_month3+'</td>'+
                            '<td>'+ value.cy_month3+'</td>'+
                            '<td>'+ value.last_year_total+'</td>'+
                            '<td>'+ value.current_year_total+'</td>'+
                            '<td>'+ value.style_totals+'</td>'+

                        '</tr>';
    });
    returnString += '</tbody></table>';
    return returnString;
    
}

function formatStylesTable ( row , rowId) {
    d = row.data();
    var nestedData = JSON.parse(d[9]);
    var months  = ($("#rolling-months").data('months'));
    var returnString = '<table class="table styleTable" id="styleTable_'+rowId+'">'+
                        '<thead>'+
                            '<th>Style Number</th>'+
                            '<th>LY '+ months.month1 +'</th>'+
                            '<th>TY '+ months.month1 +'</th>'+
                            '<th>LY '+ months.month2 +'</th>'+
                            '<th>TY '+ months.month2 +'</th>'+
                            '<th>LY '+ months.month3 +'</th>'+
                            '<th>TY '+ months.month3 +'</th>'+
                            '<th>LY Season 2 Total</th>'+
                            '<th>TY Season 2 Total</th>'+
                        '</thead>'+
                        '<tbody>';
    // returnString = '';

    $(nestedData).each(function(index, value){
        returnString += '<tr>'+
                            '<td id="'+rowId+'_style_'+index+'" data-table-id="styleTable_'+rowId+'" >'+value.style_number+'</td>'+
                            '<td>'+ value.ly_month1+'</td>'+
                            '<td>'+ value.cy_month1+'</td>'+
                            '<td>'+ value.ly_month2+'</td>'+
                            '<td>'+ value.cy_month2+'</td>'+
                            '<td>'+ value.ly_month3+'</td>'+
                            '<td>'+ value.cy_month3+'</td>'+
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
           { "className":'details-control'},
           null,null,null,null,null,null,null,null,null
         ],
         "searching": false
    });
    table.column(9).visible( false );

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
            categoryTable.column( 9 ).visible( false );
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
            
            var brandTable = $("#brandTable_"+rowId).DataTable({
                "bPaginate": false,
                "paging":   false,
                "ordering": false,
                "info":     false,
                "searching": false
            });
            $("body").data( "brandTable_"+rowId , brandTable);
            brandTable.column( 9 ).visible( false );
            tr.find("i.fa").toggleClass("fa-plus-circle").toggleClass('fa-minus-circle');
            tr.addClass('shown');
        }
    });


     $("body").on('click', ".expand_brand" , function(){
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
            row.child(formatStylesTable(row, rowId)).show();
            
            var styleTable = $("#styleTable_"+rowId).DataTable({
                "bPaginate": false,
                "paging":   false,
                "ordering": false,
                "info":     false,
                "searching": false
            });
            $("body").data( "styleTable_"+rowId , styleTable);
            tr.find("i.fa").toggleClass("fa-plus-circle").toggleClass('fa-minus-circle');
            tr.addClass('shown');
        }
    });
});