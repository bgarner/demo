$("#folder-select").click(function(){
	console.log("this");
	$("#folder-listing").modal('show');
});

$(".folder-checkbox").on('click', function(){
	$(".folder-checkbox").prop("checked", false);
	$(this).prop("checked", true);
});



$('body').on('click', '#attach-selected-folders', function(){
    
   $('.folder-checkbox').each(function(){
		if($(this).is(":checked")){
			var folder_id = $(this).attr('data-folderid');
			console.log($(this).attr("data-foldername"));
			updateDocumentFolder(folder_id);
		}
	});

   $("#folder-listing").modal('hide');
});

$("#attach-selected-folders").click(function(){
	var documentId = $("#documentID").val();
	console.log(documentId);
	console.log(folder_id);
	$.ajax({
		    url: '/admin/documentfolder/' + documentId,
		    type: 'PATCH',
		    data: { folder_id : folder_id },
		    dataType : 'json',
		    success: function(data) {
		    	console.log(data);
		   //  	if(data != null && data.validation_result == 'false') {
		   //      	var errors = data.errors;
		   //      	console.log(errors);
		   //      	if(errors.hasOwnProperty("event_type")) {
		   //      		$.each(errors.event_type, function(index){
		   //      			$("#event_type").parent().append('<div class="req">' + errors.event_type[index]  + '</div>');
		   //      		});
		   //      	}
		   //      }
		   //      else{
		   //      	$("#event_type").val(""); // empty the form
					// swal("Nice!", "'" + eventTypeName +"' has been created", "success");
					console.log(data);
					$("#folder_path").val(data);
		   //      }

		    }
		});
});
