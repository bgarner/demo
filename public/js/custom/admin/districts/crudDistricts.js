$("#add-district").click(function(){
	$("#add-district-modal").modal('show').on('shown.bs.modal', function () {
            $(".chosen").chosen({
                    width:'100%'
                });
        });
});

$(document).on("click", ".edit-district", function(e){

    var modal = $('#edit-district-modal');
    var modalBody = $('#edit-district-modal .modal-content');

    modalBody.empty();
    var districtEditLink = $(this).attr('href');
    
    modal
        .on('show.bs.modal', function() {
            modalBody.load(districtEditLink)
        })
        .modal({show:true})
        .on('shown.bs.modal', function () {
            $(".chosen").chosen({
                    width:'100%'
                });
        })
        .on('hidden.bs.modal', function() {
        });
    
    e.preventDefault();
});

$(".delete-district").click(function(){
    
    districtId = $(this).attr('data-district-id');
    console.log(districtId);
    var selector = "#district"+districtId;
    
    swal({
    title: "Are you sure?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false
    }, function () {
    
        $.ajax({
            url: '/admin/district/'+ districtId,
            type: 'DELETE',

            success: function(result) {
                result = JSON.parse(result);
                if(result.success == 'false'){
                    console.log('hello');
                    swal("Error!", result.description, "error");    
                }
                else{
                    $(selector).closest('tr').fadeOut(1000);
                    swal("Deleted!", "District deleted.", "success");
                }
            }

        });
    
    });

});