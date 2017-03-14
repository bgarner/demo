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


$("#add-documents").click(function(){
	$("#document-listing").modal('show');
});

$("#add-packages").click(function(){
	$("#package-listing").modal('show');	
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


$(document).on('click','.communication-update',function(){
  	
 
  	var hasError = false;
 	var communicationId = $("#communicationId").val();
 	
 	var subject = $("#subject").val();
	var communication_type_id = $("input[name='communication_type']").val();
	var body = CKEDITOR.instances['body'].getData();
	var start = $("#send_at").val();
	var end = $("#archive_at").val();
	var banner_id = $("input[name='banner_id']").val();
	var target_stores  = $("#storeSelect").val();
	var allStores  = $("#allStores:checked").val();

	console.log(communication_type_id);
	
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
	if( target_stores == null && typeof allStores === 'undefined' ) {
		swal("Oops!", "Target stores not selected.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	console.log(communication_type_id);
     if(hasError == false) {

		$.ajax({
		    url: '/admin/communication/' + communicationId,
		    type: 'PATCH',
		    dataType : 'json',
		    data: {

		    	subject : subject,
		  		communication_type_id: communication_type_id,
		  		body : body,
		  		sender: sender,
		  		importance: importance,
		  		send_at : start,
		  		archive_at : end,
		  		banner_id : banner_id,
		  		target_stores : target_stores,
		  		allStores : allStores,
		  		communication_documents : communication_documents,
		  		communication_packages : communication_packages,
		  		remove_document : remove_document,
		  		remove_package : remove_package

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
			$(".existing-files-container").load("/admin/communicationdocuments/"+communicationId);
			$("#files-staged-to-remove").empty();
			$("#files-selected").empty();
			$("#document-listing").find(".document-checkbox").prop('checked', false);
		});    	
    }


    return false;
});