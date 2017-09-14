var initializeTagSelector = function(){
	
	$("#tags").select2({ 
		width: '100%' , 
		tags: true,
		multiple: true,
		createTag: function (params) {
    		var term = $.trim(params.term);

		    if (term === '') {
		      return null;
		    }

		    return {
		      id: term, //id of new option 
		      text: term, //text of new option 
		      newTag: true
		    }
		}
	});
}

$("body").on('select2:select', $("#tags"), function (evt) {

	var playlist_id = $("#playlistID").val();
    if(evt.params.data.newTag){
    	$.post("/admin/tag",{ tag_name: evt.params.data.text })
    	.done(function(tag){
    		
    		//change the id of the newly added tag to be the id from db
			$('#tags option[value="'+tag.name+'"]').val(tag.id);
			
			var selectedTags = $("#tags").val();
			//update tag playlist mapping
			$.post("/admin/playlisttag",{ 'playlist_id' : playlist_id, 'tags': selectedTags })
			.done(function(){
				$('#tags').select2('destroy');
				$("#tag-selector-container").load("/admin/playlisttag/"+playlist_id, function(){
					initializeTagSelector();
					$("#tags").focus();

				});	
			});				

    	});
    }

});
$("#add-more-videos").click(function(){
	$("#video-listing").modal('show');
});


$('body').on('click', '#attach-selected-videos', function(){
	
	$('input[name^="playlist_videos"]').each(function(){

		if($(this).is(":checked")){
			$("#videos-selected").append('<tr class="selected-videos"> '+
													'<td data-video-id='+ $(this).val() +'><i class="fa fa-file-o"></i> '+ $(this).attr("data-videoname") +'</td>'+
													'<td></td>'+
													'<td> <a data-video-id="'+ $(this).val()+'" id="file'+ $(this).val()+'" class="remove-staged-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												 '</tr>');
		}

	});

	setTimeout(function() {
    	$(".playlist-update").trigger('click');
	}, 1000);
	
});



$('body').on('click', ".remove-video", function(){
	var video_id = $(this).attr('data-video-id');
	$(this).closest('.dd-item').fadeOut(200);
	$("#videos-staged-to-remove").append('<div class="remove_video"  data-video-id='+ video_id +'>')
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
		    	remove_videos: remove_videos,
		    	all_stores : getAllStoreStatus(),
		    	target_stores : getTargetStores(),
		    	target_banners : getTargetBanners()

		    },
		    
		    success: function(result) {
		    	if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("title")) {
		        		$.each(errors.title, function(index){
		        			$("#title").parent().append('<div class="req">' + errors.title[index]  + '</div>');	
		        		}); 	
		        	}
			        // if(errors.hasOwnProperty("videos")) {
			        // 	$.each(errors.videos, function(index){
			        // 		$(".existing-videos").append('<div class="req">' + errors.videos[index]  + '</div>');
			        // 	});
			        // }
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