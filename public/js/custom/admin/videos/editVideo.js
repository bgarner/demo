$(document).on('click','.video-update',function(){
  	
 
  	var hasError = false;
 	var videoId = $("#videoId").val();
 	
 	var title = $("#title").val();
	
	var description = $("#description").val();
	
	var banner_id = $("input[name='banner_id']").val();
	var featured = $("#featured:checked").val();

	var tags = $("#tagsSelected").val();

	console.log(title);
	console.log(description);
	console.log(tags);
	console.log(featured);
	
     if(hasError == false) {

		$.ajax({
		    url: '/admin/video/' + videoId,
		    type: 'PATCH',
		    data: {
		    	video_id :videoId,
		    	title : title,
		    	description : description,
		    	tags : tags,
		    	featured : featured
		    	

		    },
		    
		    success: function(result) {
		       	
		    		console.log(result);
					swal("Nice!", "'" + title +"' has been updated", "success");

		    }
		});
    }


    return false;
});


