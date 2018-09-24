var initializeTagSelector = function(resource_id, selectedTags){
	
	console.log(resource_id);
	$("#tags_" + resource_id).select2({ 
		width: '100%' , 
		tags: true,
		multiple: true,
		createTag: function (params) {
    		var term = $.trim(params.term);

		    if (term === '' && $("#tags_" + resource_id).find('option').attr("tagname", term).length >0) {
		      return null;
		    }

		    return {
		      id: term, //id of new option 
		      text: term, //text of new option 
		      newTag: true
		    }
		}
	});
	if(typeof(selectedTags) !== 'undefined'){
		$(selectedTags).each(function(index, tag){
			$('#tags_' + resource_id).val(selectedTags);
			$('#tags_' + resource_id).trigger('change');
		});
	}

}



function addTagToResource(resource_id, resource_type, evt){

    console.log(resource_id);
    if(evt.params.data.newTag){
    	$.post("/admin/tag",{ tag_name: evt.params.data.text })
    	.done(function(tag){
    		
			if(tag.existence_status == 'new'){
    			// change the id of the newly added tag to be the id from db
    			$('#tags_'+ resource_id +' option[value="'+tag.name+'"]').val(tag.id);
    		}
    		if(tag.existence_status == 'existing'){

    			var selectedTags = $('#tags_'+ resource_id).val();
    			selectedTags.splice(-1,1);
    			selectedTags.push( tag.id );
    			$('#tags_'+ resource_id).val(selectedTags);
    		}

			var selectedTags = $("#tags_" + resource_id).val();
			if(resource_id != 'new'){
				$.post("/admin/"+ resource_type +"tag",{ [resource_type + '_id'] : resource_id, 'tags': selectedTags })
				.done(function(){
					$("#tags_" + resource_id).select2('destroy');
					$("#tag-selector-container").load("/admin/"+ resource_type +"tag/"+resource_id, function(){
						initializeTagSelector(resource_id);
						$("#tags_" + resource_id).focus();

					});	
				});	
			}else{
				$('#tags_new').select2('destroy');
				$("#tag-selector-container").load("/admin/"+ resource_type +"tag/"+resource_id, function(response){
					initializeTagSelector(resource_id, selectedTags);
					$("#tags_new").focus();
				});
			}

    	});
    }

}