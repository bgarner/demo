$(document).ready(function(){            
    // $('.dirtynodestable').on('click', 'tbody td', function() {
    //     showModal(this);
    // });

    $('.dirtynodestable').on('click', '.cleannodebutton', function() {
        showModal(this);
    });

 



});


function showModal(el)
{
    $('#dirtynodemodalpdt').modal('show');
    window.nodeID = $(el).data('nodeid');

    var desc = $(el).data('desc');
    $('#dirtyNodepdtTitle').text(desc);

    var style = $(el).data('style');
    $('#dirtyNodepdtItemID span.value').text(style);

    var upc = $(el).data('upc');
    $('#dirtyNodepdtUPC span.value').text(upc);

    var qty = $(el).data('qty');
    $('#dirtyNodepdtQuantity span.value').text(qty);
    
    var dept = $(el).data('dept');
    $('#dirtyNodepdtDept span.value').text(dept);

    var subdept = $(el).data('subdept');
    $('#dirtyNodepdtSubDept span.value').text(subdept);

    var color = $(el).data('color');
    $('#dirtyNodepdtColour span.value').text(color);

    var size = $(el).data('size');
    $('#dirtyNodepdtSize span.value').text(size);

    var price = $(el).data('price');
    $('#dirtyNodepdtPrice span.value').text(price);

    

    var start_date = $(el).data('start');
    $('#dirtyNodepdtStart span.value').text(start_date);
    

    var now = "Today at " + new Date().toLocaleTimeString();

    // modalHeader.empty().html(stylenumber +" - "+ stylename +"  ("+codi+")");
    // var styleSrc = '<img src="https://fgl.scene7.com/is/image/FGLSportsLtd/'+stylenumber+'_'+ codi +'_a?hei=520"/>';

   //window.removedRow = "<tr><td>"+itemID+"</td><td>"+upc+"</td><td>"+desc+"</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>><td>"+now+"</td></tr>";

}


$('button.cleannode').on('click', function() {
    var path = location.pathname;
    path = path.replace('-pdt','');
    console.log(path);

    $.ajax({
        url: location.protocol + '//' + location.host + path + "/clean/",
        type: 'PATCH',
        data: {
            node_id : window.nodeID
        },
        success: function(result) {
            $('#nodeID_' + window.nodeID).fadeOut( 400, function() {
                // Animation complete.
                // $('.cleannodestable tr:last').after(window.removedRow);
            });
        }
    }).done(function(response){
        swal("Good job 🍭", "Node is clean!", "success");
    });
});