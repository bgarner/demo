var allStores;
var videoId = $("#videoId").val();

$(document).ready(function(){
	initializeTagSelector();		
});

var initializeTagSelector = function(){
	
	
	$("#tags_" + videoId).select2({ 
		width: '100%' , 
		tags: true,
		multiple: true,
		createTag: function (params) {
    		var term = $.trim(params.term);

		    if (term === ''  && $("#tags_" + videoId).find('option').attr("tagname", term).length >0) {
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

$("body").on('select2:select', $("#tags_" + videoId), function (evt) {

	    if(evt.params.data.newTag){
	    	$.post("/admin/tag",{ tag_name: evt.params.data.text })
	    	.done(function(tag){
	    		
	    		if(tag.existence_status == 'new'){
    			// change the id of the newly added tag to be the id from db
    			$('#tags_'+ videoId +' option[value="'+tag.name+'"]').val(tag.id);
	    		}
	    		if(tag.existence_status == 'existing'){

	    			var selectedTags = $('#tags_'+ videoId).val();
	    			selectedTags.splice(-1,1);
	    			selectedTags.push( tag.id );
	    			$('#tags_'+ videoId).val(selectedTags);
	    		}

				var selectedTags = $("#tags_" + videoId).val();
				
				//update tag video mapping
				$.post("/admin/videotag",{ 'video_id' : videoId, 'tags': selectedTags })
				.done(function(){

					var video_id = $("#videoId").val();
					$('#tags_' + video_id).select2('destroy');
					$("#tag-selector-container").load("/admin/videotag/"+video_id, function(){
						initializeTagSelector();
						$("#tags_" + video_id).focus();

					});	
				});				

	    	});
	    }

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


