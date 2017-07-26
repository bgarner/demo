$(document).on('click','.role-delete',function(){

    var eventtypeidVal = $(this).attr('data-roleId');
    var selector = "#role"+eventtypeidVal;

    swal({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
    	$.ajax({
		    url: '/admin/role/'+eventtypeidVal,
		    type: 'DELETE',
		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This Role has been deleted.", "success");
		    }
		});
        
    });

    return false;
});