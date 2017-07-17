$("#add-alerttype").click(function(){
	$("#add-alerttype-modal").modal('show');
});

$(".edit-alerttype").click(function(e){

	var modal = $('#edit-alerttype-modal');
    var modalBody = $('#edit-alerttype-modal .modal-content');

    modalBody.empty();
    var alerttypeEditLink = e.delegateTarget.href;
    
    modal
        .on('show.bs.modal', function() {
            modalBody.load(alerttypeEditLink)
        })
        .modal({show:true})
        .on('shown.bs.modal', function () {
            $('input[name="alert_type"]').focus();
        });
    
    e.preventDefault();
});

$(".delete-alerttype").click(function(){
    alertCount = $(this).attr('data-alertCount');
    alertType = $(this).attr('data-alertType');
    alertTypeId = $(this).attr('data-alertType-id');
    console.log(alertTypeId);
    var selector = "#alertType"+alertTypeId;
    if(alertCount > 0){
        swal({
            title: "Error!", 
            type: "warning", 
            text: "Cannot delete <b><i>"+ alertType +"</b></i><br><small>"+ alertCount +" alerts with this alert type exists</small>", 
            html: true 
        });
    }
    else{
        swal({
        title: "Are you sure?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
        }, function () {
        
        $.ajax({
            url: '/admin/alerttypes/'+ alertTypeId,
            type: 'DELETE',

            success: function(result) {
                $(selector).closest('tr').fadeOut(1000);
                swal("Deleted!", "Alert Type deleted.", "success");
            }

        });
        
    });

    return false;
        
    }
});