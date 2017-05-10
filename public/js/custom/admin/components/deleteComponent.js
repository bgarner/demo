$(document).on('click','.component-delete',function(){

    var eventtypeidVal = $(this).attr('data-componentId');
    var selector = "#component"+eventtypeidVal;

    swal({
        title: "Are you sure?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
    	$.ajax({
		    url: '/admin/component/'+eventtypeidVal,
		    type: 'DELETE',
		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This component has been deleted.", "success");
		    }
		});
        
    });

    return false;
});