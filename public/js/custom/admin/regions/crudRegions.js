$("#add-region").click(function(){
	$("#add-region-modal").modal('show').on('shown.bs.modal', function () {
            $(".chosen").chosen({
                    width:'100%'
                });
        });
});

$(document).on("click", ".edit-region", function(e){

    var modal = $('#edit-region-modal');
    var modalBody = $('#edit-region-modal .modal-content');

    modalBody.empty();
    var regionEditLink = $(this).attr('href');
    
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
    
    swal({
    title: "Are you sure?",
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
                result = JSON.parse(result);
                if(result.success == 'false'){
                    console.log('hello');
                    swal("Error!", result.description, "error");    
                }
                else{
                    $(selector).closest('tr').fadeOut(1000);
                    swal("Deleted!", "region deleted.", "success");
                }
                
            }

        });
        
    });

});