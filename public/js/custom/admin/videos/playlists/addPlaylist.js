var selectedTags = [];
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
    	.done(function(tag, selectedTags){
    		// change the id of the newly added tag to be the id from db
			$('#tags option[value="'+tag.name+'"]').val(tag.id);	
    	});
    }

});

$("#add-videos").click(function(){
	$("#video-listing").modal('show');
});


$('body').on('click', '#attach-selected-videos', function(){
	$("#videos-selected").empty();
	$("#videos-selected").append('<label class= "control-label col-sm-2 "> Videos attached</label>');
	$('input[name^="playlist_videos"]').each(function(){
		if($(this).is(":checked")){
			$("#videos-selected").append('<div class="selected-videos col-sm-10 col-sm-offset-2" data-videoid='+ $(this).val() +'>'+$(this).attr("data-videoname")+'</div>')
		}
	});
});


$(document).on('click','.playlist-create',function(){
  	
  	console.log(getAllStoreStatus());
  	var hasError = false;
 
	var title = $("#title").val();
	var description = CKEDITOR.instances['description'].getData();
	var banner_id = $("input[name='banner_id']").val();
	var playlist_videos = [];

	$(".selected-videos").each(function(){
		playlist_videos.push($(this).attr('data-videoid'));
	});
	var tags = $("#tags").val();

	console.log('title: ' + title);
	console.log(description);
	console.log(playlist_videos);
	
	if(title == ''){

		swal("Oops!", "Title cannot be empty.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if(playlist_videos.length <= 0){

		swal("Oops!", "Playlist cannot be empty.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}


    if(hasError == false) {

		$.ajax({
		    url: '/admin/playlist',
		    type: 'POST',
		    dataType: 'json',
		    data: {
		  		banner_id : banner_id,
		  		title : title,
		  		description : description,
		  		playlist_videos : playlist_videos,
		  		all_stores : getAllStoreStatus(),
		  		target_stores : getTargetStores(),
		  		target_banners : getTargetBanners(),
		  		store_groups : getStoreGroups(),
		  		tags : tags
		  		
		    },
		    success: function(result) { 
		        console.log(result);

		        if(result.validation_result == 'false') {
		        	
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("title")) {
		        		$.each(errors.title, function(index){
		        			$("#title").parent().append('<div class="req">' + errors.title[index]  + '</div>');	
		        		}); 	
		        	}

		        	if(errors.hasOwnProperty("playlist_videos")) {
		        		$.each(errors.playlist_videos, function(index){
		        			$("#add-videos").parent().append('<div class="req">' + errors.playlist_videos[index]  + '</div>');	
		        		}); 	
		        	}
			        
		        }
		        else{
		        	$('#createNewPlaylistForm')[0].reset(); // empty the form
		        	swal({
		        		title : 'Nice!',
		        		text : title + " has been created",
		        		type : 'success',

		        	},
		        	function(){
		        		window.location.href = '/admin/playlist';
		        	})
					// swal("Nice!", "'" + subject +"' has been created", "success");        
		        }
		        
		    }
		}).done(function(response){
			
		});    	
    }


    return false;
});
