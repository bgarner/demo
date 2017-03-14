$(document).on('click','.video-thumbnail-create',function(){
  	
 
  	var hasError = false;
 	var videoId = $(this).data("videoid"); 
 	console.log(videoId);
	
     if(hasError == false) {

		$.ajax({
		    url: '/admin/video/' + videoId + "/generatethumbnail",
		    type: 'GET',		    
		    success: function(result) {
		       	
		    		console.log(result);
					swal("Nice!", "Thumbnail has been created", "success");

		    }
		});
    }


    return false;
});


