var allStores;
var videoId = $("#videoId").val();

$(document).ready(function(){
	initializeTagSelector(videoId);
});

$("body").on('select2:select', $("#tags_" + videoId), function (evt) {	
	addTagToResource(videoId, 'video', evt);
});


$(document).on('click','.video-update',function(){
  	
 	
  	var hasError = false;

 	var videoId = $("#videoId").val();
 	
 	var title = $("#title").val();
	
	var description = $("#description").val();
	
	var featured = $("#featured:checked").val();

	var featuredOn = $("#featuredOn").val();

	var tags = $("#tags_" + videoId).val();
	
     if(hasError == false) {

		$.ajax({
		    url: '/admin/video/' + videoId,
		    type: 'PATCH',
		    data: {
		    	video_id :videoId,
		    	title : title,
		    	description : description,
		    	tags : tags,
		    	featured : featured,
		    	featuredOn : featuredOn,
		    	target_stores : getTargetStores(),
		    	target_banners : getTargetBanners(),
		    	store_groups : getStoreGroups(),
		    	all_stores : getAllStoreStatus()

		    },
		    
		    success: function(result) {
		       	
		    		console.log(result);
					swal("Nice!", "'" + title +"' has been updated", "success");

		    }
		});
    }


    return false;
});


