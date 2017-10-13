$("#allStores").change(function(){

	if ($("#allStores").is(":checked")) {

		$("#storeSelect option").each(function(){
			$(this).removeAttr('selected');
		});
		$("#storeSelect").chosen('chosen:updated');

		$("#storeSelect option").each(function(index){			
			$(this).prop('selected', 'selected');
		});
		$("#storeSelect").chosen();
		
	}
	else if ($("#allStores").not(":checked")) {
		$("#storeSelect option").each(function(){
			$(this).removeAttr('selected');
		});
		$("#storeSelect").chosen();
		
	}
});

var initializeTagSelector = function(selectedTags){
	
	$("#tags").select2({ 
		width: '100%' , 
		tags: true,
		multiple: true,
		createTag: function (params) {
    		var term = $.trim(params.term);

		    if (term === '' && $("#tags").find('option').attr("tagname", term).length >0) {
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
			$('#tags').val(selectedTags);
			$('#tags').trigger('change');
		});
	}

}

$("body").on('select2:select', $("#tags"), function (evt) {

	var communication_id = $("#communicationId").val();
    if(evt.params.data.newTag){
    	$.post("/admin/tag",{ tag_name: evt.params.data.text })
    	.done(function(tag){
    		// change the id of the newly added tag to be the id from db
			$('#tags option[value="'+tag.name+'"]').val(tag.id);	
			var selectedTags = $("#tags").val();

			$('#tags').select2('destroy');
			$("#tag-selector-container").load("/admin/communicationtag/"+communication_id, function(){
				initializeTagSelector(selectedTags);
				$("#tags").focus();

			});
			
    	});
    }

});


$(document).on('click','.communication-create',function(){
  	
  	var hasError = false;
 
	var subject = $("#subject").val();
	var communication_type_id = $("input[name='communication_type']").val();
	var body = CKEDITOR.instances['body'].getData();
	var start = $("#send_at").val();
	var end = $("#archive_at").val();
	var banner_id = $("input[name='banner_id']").val();
	// var target_stores  = $("#storeSelect").val();
	var target_stores = getTargetStores();
	var importance = "1";
	var sender = "";
	var communication_packages = [];
	var communication_documents = [];
	var allStores  = $("#allStores:checked").val();
	var tags = $("#tags").val();

	if(!communication_type_id){
		communication_type_id = $("#default_communication_type").val(); // no category

	}

	$(".communication-documents").each(function(){
		communication_documents.push($(this).attr('data-fileid'));
	});
	
	$(".selected-packages").each(function(){
		communication_packages.push($(this).attr('data-packageid'));
	});
 
    if(subject == '' || body == '') {
		swal("Oops!", "Communication title/body incomplete.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if(  start == '' || end == '' ) {
		swal("Oops!", "Start and end dated needed.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if( target_stores == null && typeof allStores === 'undefined' ) {
		swal("Oops!", "Target stores not selected.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}

    if(hasError == false) {

		$.ajax({
		    url: '/admin/communication',
		    type: 'POST',
		    dataType: 'json',
		    data: {
		  		subject : subject,
		  		communication_type_id: communication_type_id,
		  		body : body,
		  		sender: sender,
		  		importance: importance,
		  		send_at : start,
		  		archive_at : end,
		  		banner_id : banner_id,
		  		all_stores : allStores,
		  		target_stores : target_stores,
		  		communication_documents : communication_documents,
		  		communication_packages : communication_packages,
		  		tags: tags
		  		
		    },
		    success: function(result) {
		        if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("subject")) {
		        		$.each(errors.subject, function(index){
		        			$("#subject").parent().append('<div class="req">' + errors.subject[index]  + '</div>');	
		        		}); 	
		        	}
		        	
			        if(errors.hasOwnProperty("documents")) {
			        	$.each(errors.documents, function(index){
			        		$("#add-documents").parent().append('<div class="req">' + errors.documents[index]  + '</div>');
			        	});
			        }
			        
			        if(errors.hasOwnProperty("communication_type_id")) {
			        	$.each(errors.communication_type_id, function(index){
			        		$("#communication-type-selector").append('<div class="req">' + errors.communication_type_id[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("start")) {
			        	$.each(errors.start, function(index){
			        		$(".input-daterange").parent().append('<div class="req">' + errors.start[index]  + '</div>');	
			        	});
			        }
			        
			        if(errors.hasOwnProperty("end")) {
			        	$.each(errors.end, function(index){
			        		$(".input-daterange").parent().append('<div class="req">' + errors.end[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("target_stores")) {
			        	console.log(1);
			        	$.each(errors.target_stores, function(index){
			        		$("#storeSelect").parent().append('<div class="req">' + errors.target_stores[index]  + '</div>');	
			        	});
			        }
		        }
		        else{
		        	$('#createNewCommunicationForm')[0].reset(); // empty the form
		        	swal({
		        		title : 'Nice!',
		        		text : subject + " has been created",
		        		type : 'success',

		        	},
		        	function(){
		        		window.location.reload();
		        	})
					// swal("Nice!", "'" + subject +"' has been created", "success");        
		        }
		        
		    }
		}).done(function(response){
			$(".search-field").find('input').val('');
			processStorePaste();
		});    	
    }


    return false;
});
