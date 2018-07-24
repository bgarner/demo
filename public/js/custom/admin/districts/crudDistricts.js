$("#add-district").click(function(){
	$("#add-district-modal").modal('show');
});

$(".edit-district").click(function(e){

    var modal = $('#edit-district-modal');
    var modalBody = $('#edit-district-modal .modal-content');

    modalBody.empty();
    var districtEditLink = e.delegateTarget.href;
    
    modal
        .on('show.bs.modal', function() {
            modalBody.load(districtEditLink)
        })
        .modal({show:true})
        .on('shown.bs.modal', function () {
            // $('input[name="district_name"]').focus();
        })
        .on('hidden.bs.modal', function() {
        });
    
    e.preventDefault();
});

$(".delete-district").click(function(){
    
    districtId = $(this).attr('data-district-id');
    console.log(districtId);
    var selector = "#district"+districtId;
    
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
            url: '/admin/district/'+ districtId,
            type: 'DELETE',

            success: function(result) {
                $(selector).closest('tr').fadeOut(1000);
                swal("Deleted!", "District deleted.", "success");
            }

        });
        
    });

});