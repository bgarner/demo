$(".delete-tag").click(function(){

		var tag_id = $(this).attr('id');
		var token = $("input[name='_token']").val();
		var parent_row = "#tag-" + tag_id 
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
			    url: '/admin/tag/' + tag_id ,
			    type: 'DELETE',
			    data: {'_token' : token},
			    success: function(result) {
			      	console.log(result);
			      	$(parent_row).fadeOut( 1000 );
					swal("Deleted!", "This Tag has been deleted.", "success");
			    }
			});
		});
		return false;    	

	});