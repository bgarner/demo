function formatSubdeptTable ( row , rowId) {
    d = row.data();
    var nestedData = JSON.parse(d[9]);

    var months  = ($("#rolling-months").data('months'));
    var returnString = '<table class="table subdeptTable" id="subdeptTable_'+rowId+'">'+
                        '<thead>'+
                            '<th>Subdepartment</th>'+
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
        console.log(rowId);
        returnString += '<tr>'+
                            '<td class="expand_subdept" id="'+rowId+'_subdept_'+index+'" data-table-id="subdeptTable_'+rowId+'">'+
                                '<i class="fa fa-plus-circle"></i> '+value.subdept+'</td>'+
                            '<td>'+ value.ly_month1+'</td>'+
                            '<td>'+ value.cy_month1+'</td>'+
                            '<td>'+ value.ly_month2+'</td>'+
                            '<td>'+ value.cy_month2+'</td>'+
                            '<td>'+ value.ly_month3+'</td>'+
                            '<td>'+ value.cy_month3+'</td>'+
                            '<td>'+ value.last_year_total+'</td>'+
                            '<td>'+ value.current_year_total+'</td>'+
                            '<td>'+ value.category_totals+'</td>'+

                        '</tr>';
                        
    });
    returnString += '</tbody></table>';
    return returnString;
    
}

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
        console.log(value);
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
                            '<th>Style Name</th>'+
                            '<th>LY '+ months.month1 +'</th>'+
                            '<th>TY '+ months.month1 +'</th>'+
                            '<th>LY '+ months.month2 +'</th>'+
                            '<th>TY '+ months.month2 +'</th>'+
                            '<th>LY '+ months.month3 +'</th>'+
                            '<th>TY '+ months.month3 +'</th>'+
                            '<th>LY Season Total</th>'+
                            '<th>TY Season Total</th>'+
                            '<th>img</th>'+
                        '</thead>'+
                        '<tbody>';
    // returnString = '';

    $(nestedData).each(function(index, value){
        returnString += '<tr>'+
                            '<td class="viewStyle" id="'+rowId+'_style_'+index+'" data-table-id="styleTable_'+rowId+'" >'+value.style_number+'</td>'+
                            '<td>'+ value.style_name+'</td>'+
                            '<td>'+ value.ly_month1+'</td>'+
                            '<td>'+ value.cy_month1+'</td>'+
                            '<td>'+ value.ly_month2+'</td>'+
                            '<td>'+ value.cy_month2+'</td>'+
                            '<td>'+ value.ly_month3+'</td>'+
                            '<td>'+ value.cy_month3+'</td>'+
                            '<td>'+ value.last_year_total+'</td>'+
                            '<td>'+ value.current_year_total+'</td>'+
                            '<td><img src="https://fgl.scene7.com/is/image/FGLSportsLtd/'+value.style_number+'_'+ value.codi_number +'_a?hei=520"/></td>'+

                        '</tr>';
                        
    });
    returnString += '</tbody></table>';
    return returnString;
    
}



$(document).ready(function(){

    $('tbody').on('click', '.expand_dept', function () {

        var tr = $(this).closest('tr');
        var rowId = $(tr).find(".expand_dept").attr('id');
        console.log(rowId);
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
            tr.find("i.fa").toggleClass("fa-minus-circle").toggleClass('fa-plus-circle');
            
        }
        else {
            // Open this row
            row.child(formatSubdeptTable(row, rowId)).show();
            
            var subdeptTable = $("#subdeptTable_"+rowId).DataTable({
                "bPaginate": false,
                "paging":   false,
                "ordering": false,
                "info":     false,
                "searching": false
            });
            // push the datatable instance to be used later to view the brands
            $("body").data( "subdeptTable_"+rowId , subdeptTable);
            subdeptTable.column( 9 ).visible( false );
            tr.addClass('shown');
            tr.find("i.fa").toggleClass("fa-plus-circle").toggleClass('fa-minus-circle');
        }
    } );

    $('tbody').on('click', '.expand_subdept', function () {


        if($(this).attr('data-toplevel')){
            var tr = $(this).closest('tr');
            var rowId = $(tr).find(".expand_subdept").attr('id');
            var row = table.row( tr );
        }
        else{
            var tr = $(this).parent();
            var parentTableId = $(this).attr('data-table-id');
            var rowId  = $(this).attr('id');
            var row = $( "body" ).data(parentTableId).row( tr );    
        }

         
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
            styleTable.column( 10 ).visible( false );
            tr.find("i.fa").toggleClass("fa-plus-circle").toggleClass('fa-minus-circle');
            tr.addClass('shown');
        }
    });

    $("body").on('click', ".viewStyle", function(e){
        e.preventDefault();
        var tr = $(this).parent();
        var parentTableId = $(this).attr('data-table-id');
        var rowId  = $(this).attr('id');
        var row = $( "body" ).data(parentTableId).row( tr );

        openStyleInModal(row.data());


    });


    var openStyleInModal = function(data){
        
        var modal = $('#view-style-modal');
        var modalHeader = $('#view-style-modal .modal-title');
        var modalBody = $('#view-style-modal .modal-body');

        var styleNumber = data[0];
        var styleName = data[1];
        var styleSrc = data[10];
        modalHeader.empty().html(styleNumber +" - "+ styleName);
        modalBody.empty().html(styleSrc);
        
        modal.modal({show:true})
            
    }
});