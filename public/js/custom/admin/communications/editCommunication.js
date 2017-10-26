$('body').on('blur','#targets_chosen', function(){
	
	var target_stores = getTargetStores();
	var target_banners = getTargetBanners();
	var store_groups = getStoreGroups();
	var communication_id = $("#communicationId").val();
	
	$("#communication-type-selector").empty()
									.load('/admin/target/communicationtypes', { 
										target_stores : target_stores, 
										target_banners : target_banners,
										store_groups : store_groups,
										communication_id : communication_id
									 });

});

$('body').on( 'click', ".comm_type_dropdown_item", function(){

	$(".selected_comm_type").empty();
	var comm_typeid = $(this).attr('data-comm-typeid');
	var comm_typeColour = $(this).attr('data-comm-typecolour');
	var comm_type = $(this).attr('data-comm-type');

	$("input[name='communication_type']").val(comm_typeid);
	$(".selected_comm_type").append('<i class="fa fa-circle text-'+ comm_typeColour + '"> </i> '+ comm_type);
});

var initializeTagSelector = function(selectedTags){
	
	$("#tags").select2({ 
		width: '100%' , 
		tags: true,
		multiple: true,
		createTag: function (params) {
    		var term = $.trim(params.term);

		    if (term === ''  && $("#tags").find('option').attr("tagname", term).length >0) {
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

	var communication_id = $("#communicationId").val();
    if(evt.params.data.newTag){
    	$.post("/admin/tag",{ tag_name: evt.params.data.text })
    	.done(function(tag){
    		
    		//change the id of the newly added tag to be the id from db
			$('#tags option[value="'+tag.name+'"]').val(tag.id);
			
			var selectedTags = $("#tags").val();
			//update tag communication mapping
			$.post("/admin/communicationtag",{ 'communication_id' : communication_id, 'tags': selectedTags })
			.done(function(){
				$('#tags').select2('destroy');
				$("#tag-selector-container").load("/admin/communicationtag/"+communication_id, function(){
					initializeTagSelector();
					$("#tags").focus();

				});	
			});				

    	});
    }

});


$(document).on('click','.communication-update',function(){
  	
 
  	var hasError = false;
 	var communicationId = $("#communicationId").val();
 	
 	var subject = $("#subject").val();
	var communication_type_id = $("input[name='communication_type']").val();
	var body = CKEDITOR.instances['body'].getData();
	var start = $("#send_at").val();
	var end = $("#archive_at").val();
	var banner_id = $("input[name='banner_id']").val();
	var target_stores = getTargetStores();
	var target_banners = getTargetBanners();
	var store_groups = getStoreGroups();
	var all_stores = getAllStoreStatus();
	var tags = $("#tags").val();

	var importance = "1";
	var sender = "";

	var remove_document = [];
	var remove_package   = [];
	var communication_documents = [];
	var communication_packages = [];


	$(".remove_document").each(function(){
		remove_document.push($(this).attr('data-documentid'));
	});
	$(".remove_package").each(function(){
		remove_package.push($(this).attr('data-packageid'));
	});
	
	$(".selected-files").each(function(){
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
	if( target_stores == null || all_stores == null || store_groups == null ) {
		swal("Oops!", "Target stores not selected.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	
     if(hasError == false) {

		$.ajax({
		    url: '/admin/communication/' + communicationId,
		    type: 'PATCH',
		    dataType : 'json',
		    data: {


				subject                 : subject,
				communication_type_id   : communication_type_id,
				body                    : body,
				sender                  : sender,
				importance              : importance,
				send_at                 : start,
				archive_at              : end,
				target_stores           : target_stores,
				all_stores              : all_stores,
				target_banners          : target_banners,
				store_groups            : store_groups,
				communication_documents : communication_documents,
				communication_packages  : communication_packages,
				remove_document         : remove_document,
				remove_package          : remove_package,
		  	tags                    : tags

		    },
		    
		    success: function(result) {
		       
		        console.log(result);
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
			        	$.each(errors.target_stores, function(index){
			        		$("#storeSelect").parent().append('<div class="req">' + errors.target_stores[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("allStores")) {
			        	$.each(errors.allStores, function(index){
			        		$("#storeSelect").parent().append('<div class="req">' + errors.allStores[index]  + '</div>');	
			        	});
			        }
		        }
		        else{
		        	console.log(result); 
					swal("Nice!", "'" + subject +"' has been updated", "success");
		        } 
		        

		    }
		}).done(function(response){
			console.log(response);
			$("#files-staged-to-remove").empty();
			$("#files-selected").empty();
			$("#files-selected").load("/admin/communicationdocuments/"+communicationId);
			$("#document-listing").find(".document-checkbox").prop('checked', false);
		});    	
    }


    return false;
});