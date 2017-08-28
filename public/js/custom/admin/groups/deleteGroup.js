$(document).on('click','.group-delete',function(){

    var eventtypeidVal = $(this).attr('data-groupId');
    var selector = "#group"+eventtypeidVal;

    swal({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
    	$.ajax({
		    url: '/admin/group/'+eventtypeidVal,
		    type: 'DELETE',
		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This Section has been deleted.", "success");
		    }
		});
        
    });

    return false;
});