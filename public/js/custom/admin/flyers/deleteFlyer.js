$(".delete_flyer_item").click(function(){

	var flyerItemId = $(this).closest('.flyerItem').attr('data-flyer-item-id');
	// var selector = "#communication"+commId;

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
		    url: '/admin/flyer/'+ flyerItemId,
		    type: 'DELETE',
		    data : { "_token": $('meta[name="csrf-token"]').attr('content') },
		    success: function(result) {
		        $(".flyerItem[data-flyer-item-id="+flyerItemId+"]").fadeOut(1000);
		        swal("Deleted!", "This flyer item has been deleted.", "success");
		    }

		});
        
    });

    return false;
});