$("#add-documents").click(function(){
	$("#document-listing").modal('show');
});


$('body').on('click', '#attach-selected-files', function(){
	$(".selected-files").remove();
	$('input[name^="package_files"]').each(function(){
		if($(this).is(":checked")){
			$("#files-selected").append('<div class="col-sm-10 col-sm-offset-2"><div class="row">'+
											'<div class="feature-files col-md-8 " data-fileid='+ $(this).val() +'> '+
												'<div class="feature-filename selected-files" data-fileid='+ $(this).val() +'><i class="fa fa-file-o"></i> '+  $(this).attr("data-filename")+
											'</div></div>'+
											'<a data-document-id="'+ $(this).val()+'" id="file'+ $(this).val()+'" class="remove-staged-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div></div>')
		}
	});
});


$('body').on('click', ".remove-file", function(){
	var document_id = $(this).attr('data-document-id');
	$(this).parent().fadeOut(200);
	$("#files-staged-to-remove").append('<div class="remove_document"  data-documentid='+ document_id +'>')
});

$("body").on('click', ".remove-staged-file", function(){
	
	var document_id = $(this).attr('data-document-id');
	$(".feature-files[data-fileid = '" + document_id + "']").remove();
	$(this).parent().fadeOut(200);

});


$(document).on('click','.task-update',function(){
  	
 	console.log('click click');
  	var hasError = false;
 	var taskId = $("#taskId").val();
 	
 	var title = $("#title").val();
	var description = CKEDITOR.instances['description'].getData();
	var publish_date = $("#publish_date").val();
	var due_date = $("#due_date").val();
	var banner_id = $("input[name='banner_id']").val();
	var target_stores  = getTargetStores();
	var all_stores  = $("#allStores:checked").val();
	var send_reminder = ($("#send_reminder").prop('checked') === true)?1:0;
	var status_type_id = $("#status_type_id").val();

	var remove_document = [];
	var task_documents = [];


	$(".remove_document").each(function(){
		remove_document.push($(this).attr('data-documentid'));
	});
	
	$(".selected-files").each(function(){
		task_documents.push($(this).attr('data-fileid'));
	});

	var target_stores = getTargetStores();
	var target_banners = getTargetBanners();
	var store_groups = getStoreGroups();
	var all_stores = getAllStoreStatus();

	console.log( target_stores );
	console.log( target_banners );
	console.log( store_groups );
	console.log( all_stores );
	

    if(title == '' ) {
		swal("Oops!", "We need a title.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	
	if( target_stores == null && typeof all_stores === 'undefined' ) {
		swal("Oops!", "Target stores not selected.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	
    if(hasError == false) {

		$.ajax({
		    url: '/admin/task/' + taskId,
		    type: 'PATCH',
		    dataType : 'json',
		    data: {

		    	title : title,
		  		description : description,
		  		publish_date : publish_date,
		  		due_date : due_date,
		  		task_documents : task_documents,
		  		remove_document : remove_document,
		  		status_type_id : status_type_id,
		  		target_stores : target_stores,
		  		all_stores : all_stores,
		    	target_banners : target_banners,
		    	store_groups : store_groups,

		    },
		    
		    success: function(result) {
		       
		        if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("title")) {
		        		$.each(errors.title, function(index){
		        			$("#title").parent().append('<div class="req">' + errors.title[index]  + '</div>');	
		        		}); 	
		        	}
		        	
			        if(errors.hasOwnProperty("documents")) {
			        	$.each(errors.documents, function(index){
			        		$("#add-documents").parent().append('<div class="req">' + errors.documents[index]  + '</div>');
			        	});
			        }
			        
			        if(errors.hasOwnProperty("publish_date")) {
			        	$.each(errors.publish_date, function(index){
			        		$(".input-daterange").parent().append('<div class="req">' + errors.publish_date[index]  + '</div>');	
			        	});
			        }
			        
			        if(errors.hasOwnProperty("due_date")) {
			        	$.each(errors.due_date, function(index){
			        		$(".input-daterange").parent().append('<div class="req">' + errors.due_date[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("target_stores")) {
			        	$.each(errors.target_stores, function(index){
			        		$("#storeSelect").parent().append('<div class="req">' + errors.target_stores[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("all_stores")) {
			        	$.each(errors.allStores, function(index){
			        		$("#storeSelect").parent().append('<div class="req">' + errors.allStores[index]  + '</div>');	
			        	});
			        }
		        }
		        else{
					swal("Nice!", "'" + title +"' has been updated", "success");
		        } 
		        

		    }
		}).done(function(response){
			$(".existing-files-container").load("/admin/task/" + taskId + "/documents/");
			$("#files-staged-to-remove").empty();
			$("#files-selected").empty();
			$("#document-listing").find(".document-checkbox").prop('checked', false);
		});    	
    }


    return false;
});