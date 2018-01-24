$(document).ready(function(){            
    $('.dirtynodestable').on('click', 'tbody td', function() {

        $('#dirtynodemodal').modal('show');

        window.nodeID = $(this).closest("tr").find('td:eq(0)').text();

        var itemID = $(this).closest("tr").find('td:eq(1)').text();
        $('#dirtyNodeItemID span.value').text(itemID);

        var desc = $(this).closest("tr").find('td:eq(2)').text();
        $('#dirtyNodeTitle').text(desc);

        var upc = $(this).closest("tr").find('td:eq(3)').text();
        $('#dirtyNodeUPC span.value').text(upc);

        var start_date = $(this).closest("tr").find('td:eq(4)').text();

        var qty = $(this).closest("tr").find('td:eq(5)').text();
        $('#dirtyNodeQuantity span.value').text(qty);

        var now = "Today at " + new Date().toLocaleTimeString();

        window.removedRow = "<tr><td>"+itemID+"</td><td>"+desc+"</td><td>"+upc+"</td><td>"+start_date+"</td><td>"+qty+"</td><td>"+now+"</td></tr>";

    });

});

$('button.cleannode').on('click', function() {

    $.ajax({
        url: location.protocol + '//' + location.host + location.pathname + "/clean/",
        type: 'PATCH',
        data: {
            node_id : window.nodeID
        },
        success: function(result) {
            $('#nodeID_' + window.nodeID).fadeOut( 400, function() {
                // Animation complete.
                $('.cleannodestable tr:last').after(window.removedRow);
            });
        }
    }).done(function(response){
        swal("Good job 🍭", "Node is clean!", "success");
    });
});