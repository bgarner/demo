$(".video-delete").on('click', function(){


    var videoId = $(this).attr('data-video');
    var selector = "#video"+videoId;

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
		    url: '/admin/video/'+videoId,
		    type: 'DELETE',
		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This video has been deleted.", "success");
		    }
		});
        
    });

    return false;

});