$(document).on('click','.eventtype-delete',function(){

    var eventtypeidVal = $(this).attr('data-eventtype');
    var selector = "#eventtype"+eventtypeidVal;

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
            url: '/admin/eventtypes/'+eventtypeidVal,
            type: 'DELETE',
            success: function(result) {
                var didDelete = JSON.parse(result);
                if(didDelete.success){
                    $(selector).closest('tr').fadeOut(1000);
                    swal("Deleted!", "This Event Type has been deleted.", "success");
                } else {
                    swal("Sorry", "We can't remove this event type, there are still active events using it.", "error");
                }
            }
        });
    });

    return false;
});