$(".playlist-delete").on('click', function(){


    var playlistId = $(this).attr('data-playlist');
    var selector = "#playlist"+playlistId;

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
		    url: '/admin/playlist/'+playlistId,
		    type: 'DELETE',
		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This playlist has been deleted.", "success");
		    }
		});
        
    });

    return false;

});