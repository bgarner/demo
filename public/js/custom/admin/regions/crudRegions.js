$("#add-region").click(function(){
	$("#add-region-modal").modal('show');
});

$(".edit-region").click(function(e){

    var modal = $('#edit-region-modal');
    var modalBody = $('#edit-region-modal .modal-content');

    modalBody.empty();
    var regionEditLink = e.delegateTarget.href;
    
    modal
        .on('show.bs.modal', function() {
            modalBody.load(regionEditLink)
        })
        .modal({show:true})
        .on('shown.bs.modal', function () {
            // $('input[name="region_name"]').focus();
        })
        .on('hidden.bs.modal', function() {
        });
    
    e.preventDefault();
});

$(".delete-region").click(function(){
    
    regionId = $(this).attr('data-region-id');
    console.log(regionId);
    var selector = "#region"+regionId;
    
    // else{
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
            url: '/admin/region/'+ regionId,
            type: 'DELETE',

            success: function(result) {
                $(selector).closest('tr').fadeOut(1000);
                swal("Deleted!", "region deleted.", "success");
            }

        });
        
    });

});