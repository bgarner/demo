$(".delete_flyer_item").click(function(){

	var flyerItemId = $(this).closest('.flyerItem').attr('data-flyer-item-id');

	swal({
		title: "Are you sure?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, delete it!",
		closeOnConfirm: false
    	}, function () {
	    
		$.ajax({
		    url: '/admin/flyeritem/'+ flyerItemId,
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


$(".delete-flyer").click(function(){

	var flyerId = $(this).attr('data-flyer-id');

	swal({
		title: "Are you sure?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, delete it!",
		closeOnConfirm: false
    	}, function () {
	    
		$.ajax({
		    url: '/admin/flyer/'+ flyerId,
		    type: 'DELETE',
		    data : { "_token": $('meta[name="csrf-token"]').attr('content') },
		    success: function(result) {
		        $(".flyer[data-flyer-id="+flyerId+"]").fadeOut(1000);
		        swal("Deleted!", "This flyer item has been deleted.", "success");
		    }

		});
        
    });

    return false;
})