$(document).ready(function(){            
    $('.dirtynodestable').on('click', 'tbody td', function() {
        showModal(this);
    });

    $('.dirtynodestable').on('click', '.cleannodebutton', function() {
        showModal(this);
    });
});


function showModal(el)
{
    $('#dirtynodemodal').modal('show');

    window.nodeID = $(el).closest("tr").find('td:eq(0)').text();
    console.log(window.nodeID);

    var itemID = $(el).closest("tr").find('td:eq(2)').text();
    $('#dirtyNodeItemID span.value').text(itemID);

    var desc = $(el).closest("tr").find('td:eq(4)').text();
    $('#dirtyNodeTitle').text(desc);

    var upc = $(el).closest("tr").find('td:eq(3)').text();
    $('#dirtyNodeUPC span.value').text(upc);

    var start_date = $(el).closest("tr").find('td:eq(7)').text();

    var qty = $(el).closest("tr").find('td:eq(9)').text();
    $('#dirtyNodeQuantity span.value').text(qty);

    var now = "Today at " + new Date().toLocaleTimeString();

    // modalHeader.empty().html(stylenumber +" - "+ stylename +"  ("+codi+")");
    // var styleSrc = '<img src="https://fgl.scene7.com/is/image/FGLSportsLtd/'+stylenumber+'_'+ codi +'_a?hei=520"/>';

    window.removedRow = "<tr><td>"+itemID+"</td><td>"+upc+"</td><td>"+desc+"</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>><td>"+now+"</td></tr>";

}


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