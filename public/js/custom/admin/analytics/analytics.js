$(document).ready(function(){
    var table = $('#communication_analytics').DataTable({
        "info"   :false,
        "bPaginate": false,
        "paging":   false,
        "columns": [
        null,
        {'width': '40%'},
        null,null,
        {"visible": false},
        {"visible": false},
        {"visible": false}
        ],
        "searching": false
    });

    var urgentNoticeTable = $('#urgent_notice_analytics').DataTable({
        "info"   :false,
        "bPaginate": false,
        "paging":   false,
        "columns": [
        null,
        {'width': '40%'},
        null,null,
        {"visible": false},
        {"visible": false},
        {"visible": false}
        ],
        "searching": false
    });

    var taskTable = $('#task_analytics').DataTable({
        "info"   :false,
        "bPaginate": false,
        "paging":   false,
        "columns": [
        null,
        {'width': '40%'},
        null,null,
        {"visible": false},
        {"visible": false},
        {"visible": false}
        ],
        "searching": false
    });



    $('#communication_analytics tbody').on('click', 'tr.details-control', function () {
        var tr = $(this);
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });

    $('#urgent_notice_analytics tbody').on('click', 'tr.un-details-control', function () {
        var tr = $(this);
        var row = urgentNoticeTable.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });


    $('#task_analytics tbody').on('click', 'tr.task-details-control', function () {
        var tr = $(this);
        var row = taskTable.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });

    $('#task_analytics tbody').on('click', 'span.store', function () {
        var store = $(this).text();
        $.ajax({
            url: '/api/store/'+ store, //set in /public/js/env.js
            type: 'GET',
            success: function(result) {
                var storeString =  result.address + "\n" + titleCase(result.city) + ", " + result.province;
                swal(result.store_number + " " + result.name , storeString, "info");
                }    
            });
    });

});

function titleCase(str) {
    str = str.toLowerCase().split(' ');
    for (var i = 0; i < str.length; i++) {
      str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1); 
    }
    return str.join(' ');
}

var format = function( d ) {

    // `d` is the original data object for the row

    var opened = JSON.parse(d[4]);
    var sent_to = JSON.parse(d[6]);
    var sent_to_stores = getStoresString(sent_to, opened);

    return '<tr>'+
                '<td>'+sent_to_stores+'</td>'+
            '</tr>';
}

var getStoresString = function(sent_to, opened){
    var returnString = '<td>';
    $.each( sent_to, function( key, value ) {
        if($.inArray(value, opened) >= 0){
            returnString += '<span class="store btn btn-xs active-store">'+value+'</span>';
        }
        else{
            returnString += '<span class="store btn btn-xs btn-default">'+value+'</span>';
        }

    });

    returnString += '</td>';

    return returnString;
}

