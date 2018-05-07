$(".delete-user").click(function(){

	var user_id = $(this).attr('data-userid');
	
	var selector = "#user"+user_id;
	console.log(selector);

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
		    url: '/form/user/'+ user_id,
		    type: 'DELETE',

		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This user has been deleted.", "success");
		    }

		});
        
    });

    return false;
});