$(".delete-task").click(function(){

	var commId = $(this).attr('data-task');
	var selector = "#task"+commId;

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
		    url: '/admin/task/'+ commId,
		    type: 'DELETE',

		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This task has been deleted.", "success");
		    }

		});
        
    });

    return false;
});