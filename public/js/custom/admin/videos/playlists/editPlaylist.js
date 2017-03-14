$("#add-more-videos").click(function(){
	$("#video-listing").modal('show');
});


$('body').on('click', '#attach-selected-videos', function(){
	
	$(".selected-videos").remove();
	$('input[name^="playlist_videos"]').each(function(){
		if($(this).is(":checked")){
			$(".playlist-videos-table tbody").append('<tr class="selected-videos"> '+
													'<td data-video-id='+ $(this).val() +'><i class="fa fa-file-o"></i> '+ $(this).attr("data-videoname") +'</td>'+
													'<td></td>'+
													'<td> <a data-video-id="'+ $(this).val()+'" id="file'+ $(this).val()+'" class="remove-staged-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												 '</tr>');
		}

		if($(".playlist-videos-table").hasClass('hidden') )	{
			console.log($(".playlist-videos-table tbody .playlist-videos").length);
			$(".playlist-videos-table").removeClass('hidden');
		}
	});
});



$('body').on('click', ".remove-video", function(){
	console.log('remove video');
	var video_id = $(this).attr('data-video-id');
	console.log(video_id);
	$(this).closest('.playlist-videos').fadeOut(200);
	$("#videos-staged-to-remove").append('<div class="remove_video"  data-video-id='+ video_id +'>')
});



$("body").on('click', ".remove-staged-video", function(){
	
	
	var video_id = $(this).attr('data-video-id');
	console.log('remove staged file' + video_id);
	$(this).closest('.selected-video').remove();
	console.log($(this).closest('.selected-video'));
	$(this).closest('.selected-video').fadeOut(200);

});



$(document).on('click','.playlist-update',function(){
  	
 
  	var hasError = false;
 	var playlistID = $("#playlistID").val();
 	
	var title = $("#playlist_title").val();
	var description = CKEDITOR.instances['description'].getData();
	
	var remove_videos = [];
	var playlist_videos = [];
	
	
	$(".remove_video").each(function(){
		remove_videos.push($(this).attr('data-video-id'));
	});
	
	$(".selected-videos").each(function(){
		playlist_videos.push($(this).find('td:first').attr('data-video-id'));
	});

	console.log(title);
	console.log(remove_videos);
	console.log(playlist_videos);

     if(hasError == false) {
     	
		$.ajax({
		    url: '/admin/playlist/' + playlistID ,
		    type: 'PATCH',
			dataType: 'json',
		    data: {
		    	title : title,
		    	description : description,
		    	playlist_videos:  playlist_videos,
		    	remove_videos: remove_videos

		    },
		    
		    success: function(result) {
		    	if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("title")) {
		        		$.each(errors.title, function(index){
		        			$("#title").parent().append('<div class="req">' + errors.title[index]  + '</div>');	
		        		}); 	
		        	}
			        if(errors.hasOwnProperty("playlist_videos")) {
			        	$.each(errors.videos, function(index){
			        		$(".existing-videos").append('<div class="req">' + errors.playlist_videos[index]  + '</div>');
			        	});
			        }
			        if(errors.hasOwnProperty("videos")) {
			        		swal("Error!", "'" + errors.videos +"'", "error");
			        		// $(".existing-videos").append('<div class="req">' + errors.videos  + '</div>');
			        	
			        }
			        
			    }
	        
		        else{
		        	swal("Nice!", "'" + title +"' has been updated", "success");
			    }
		    }
		}).done(function(response){
			console.log(response);
			console.log("********");
			$(".existing-videos-container").load("/admin/playlistvideos/"+playlistID);
			$("#videos-staged-to-remove").empty();
			$("#videos-selected").empty();
			$("#video-listing").find(".video-checkbox").prop('checked', false);
			
		});    	
    }


    return false;
});