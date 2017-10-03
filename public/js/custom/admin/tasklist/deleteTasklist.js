$(".delete-tasklist").click(function(){

	var listId = $(this).attr('data-tasklist');
	var selector = "#tasklist"+listId;

	swal({
		title: "Are you sure?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, delete it!",
		closeOnConfirm: false
    	}, function () {
	    
		$.ajax({
		    url: '/admin/tasklist/'+ listId,
		    type: 'DELETE',

		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This tasklist has been deleted.", "success");
		    }

		});
        
    });

    return false;
});