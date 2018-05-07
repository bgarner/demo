$(document).on('click','.group-delete',function(){

    var group_id = $(this).attr('data-groupId');
    var selector = "#group"+group_id;

    swal({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
    	$.ajax({
		    url: '/form/group/'+group_id,
		    type: 'DELETE',
		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This group has been deleted.", "success");
		    }
		});
        
    });

    return false;
});