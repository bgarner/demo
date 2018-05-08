$(document).ready(function(){            
    $('.dirtynodestable').on('click', 'tbody td', function() {
        showModal(this);
    });

    // $('.dirtynodestable').on('click', '.cleannodebutton', function() {
    //     showModal(this);
    // });
});


function showModal(el)
{
    $('#dirtynodemodal').modal('show');
    console.log(el);
    window.nodeID = $(el).closest("tr").find('td:eq(0)').text();
    window.item_id_sku = $(el).parent().find(".item_id_sku").val();
    window.node_key = $(el).parent().find(".node_key").val();

    console.log("our ID: " + window.nodeID);
    console.log("item_id_sku: " + window.item_id_sku);
    console.log("node_key: " + window.node_key);

    var itemID = $(el).closest("tr").find('td:eq(2)').text();
    $('#dirtyNodeItemID span.value').text(itemID);

    var desc = $(el).closest("tr").find('td:eq(4)').text();
    $('#dirtyNodeTitle').text(desc);

    var upc = $(el).closest("tr").find('td:eq(3)').text();
    $('#dirtyNodeUPC span.value').text(upc);

    var start_date = $(el).closest("tr").find('td:eq(7)').text();

    var qty = $(el).closest("tr").find('td:eq(8)').text();
    $('#dirtyNodeQuantity span.value').text(qty);

    var now = "Today at " + new Date().toLocaleTimeString();

    // modalHeader.empty().html(stylenumber +" - "+ stylename +"  ("+codi+")");
    // var styleSrc = '<img src="https://fgl.scene7.com/is/image/FGLSportsLtd/'+stylenumber+'_'+ codi +'_a?hei=520"/>';

    window.removedRow = "<tr><td>"+itemID+"</td><td>"+upc+"</td><td>"+desc+"</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>><td>"+now+"</td></tr>";

}

$('button.cleannode').on('click', function() {

    $.ajax({
        url: "http://ordermgmt-qat.cicada.cs.ctc/OrderManagement/manageInventoryNodeControl",
        type: 'POST',
        dataType: "JSON",
        crossDomain: true,
        contentType: "application/json",
        data: {
            ItemID: window.item_id_sku,
            Node: window.node_key,
            RequestedBy: localStorage.getItem("userStoreNumber"),
            OrganizationCode: "FGL"
        },
        success: function(result){
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            $.ajax({
                url: location.protocol + '//' + location.host + location.pathname + "/clean/",
                type: 'PATCH',
                beforeSend: function(request) {
                    request.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
                },
                data: {
                    node_id : window.nodeID,
                    //DOM_API_result: result.stringify()
                    DOM_API_result: JSON.stringify(window.result)
                },
                success: function(result) {
                    $('#nodeID_' + window.nodeID).fadeOut( 400, function() {
                        // Animation complete.
                        $('.cleannodestable tr:last').after(window.removedRow);
                    });
                }, 
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    swal("Something went wrong", "Couldn't move node to cleaned nodes table", "error");
                 }
                   
            }).done(function(response){
                swal("Good job 🍭", "Node is clean!", "success");
            });
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            swal("Something went wrong", "Couldn't make connection to DOM", "error");
         }
        
    })
});