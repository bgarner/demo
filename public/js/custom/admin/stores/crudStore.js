$("#add-store").click(function(){
	$("#add-store-modal").modal('show').on('shown.bs.modal', function () {
            $(".chosen").chosen({
                    width:'100%'
                });
        });
});

$(".edit-store").click(function(e){

    var modal = $('#edit-store-modal');
    var modalBody = $('#edit-store-modal .modal-content');

    modalBody.empty();
    var storeEditLink = e.delegateTarget.href;
    
    modal
        .on('show.bs.modal', function() {
            modalBody.load(storeEditLink)
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

$(".delete-store").click(function(){
    
    storeId = $(this).attr('data-store-id');
    console.log(storeId);
    var selector = "#store"+storeId;
    
    swal({
    title: "Are you sure?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes, delete it!",
    closeOnConfirm: false
    }, function () {
    
        $.ajax({
            url: '/admin/store/'+ storeId,
            type: 'DELETE',

            success: function(result) {
                result = JSON.parse(result);
                if(result.success == 'false'){
                    console.log('hello');
                    swal("Error!", result.description, "error");    
                }
                else{
                    $(selector).closest('tr').fadeOut(1000);
                    swal("Deleted!", "store deleted.", "success");
                }
            }

        });
    
    });

});