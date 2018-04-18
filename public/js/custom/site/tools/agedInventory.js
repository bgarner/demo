$( ".setlocation" ).click(function() {

    //get the id, etc of the item we are setting
    var storenumber = localStorage.getItem('userStoreNumber').replace("A", "");
    if(storenumber.charAt(0) == "0"){
        storenumber = storenumber.slice(1);	
    }
    var id = $(this).data('id');
    var loc = $(this).data('loc');  //front or back
    var checked = $(this).data('checked');  //set or not
    var action;
    if(checked == 1){
        action = "unset";
    } else {
        action = "set";
    }

        //add the spinner... fa fa-spinner fa-spin
    $(this).removeClass('btn-default btn-outline').addClass('btn-warning').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Updating...');
    
    var $t = $(this); //setting the "this" so we can use in the ajax block...
    $.ajax({
        url: "/tools/agedinventory/update",
        type: 'patch',
        data: {
            storenumber: storenumber,
            id: id,
            location: loc, //front or back
            action: action //set or unset
        },
        success: function(result) {
        }
    }).done(function(response){
        //$(element).closest("tr").after( table );
            if(action == "set"){
                $t.removeClass('btn-warning').addClass('btn-success').html('<i class="fa fa-check" aria-hidden="true"></i> ' + loc);
                $t.data('checked', 1);
            } else {
                //setting back to the default look
                $t.removeClass('btn-warning').addClass('btn-default btn-outline').html(loc);
                $t.data('checked', 0);
            }
    });
    
});