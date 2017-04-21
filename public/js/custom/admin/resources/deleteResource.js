$(document).on('click','.resource-delete',function(){

    var resourceId = $(this).attr('data-resourceId');
    var selector = "#resource"+resourceId;

    swal({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
    	$.ajax({
		    url: '/admin/resource/'+resourceId,
		    type: 'DELETE',
		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This Resource has been deleted.", "success");
		    }
		});
        
    });

    return false;
});