$("#folder-select").click(function(){
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
			updateDocumentFolder(folder_id);
		}
	});

   $("#folder-listing").modal('hide');
});

// $("#attach-selected-folders").click(function(){
var updateDocumentFolder = function(folder_id){
	var documentId = $("#documentID").val();

	console.log(documentId);
	console.log(folder_id);
	$.ajax({
		    url: '/admin/documentfolder/' + documentId,
		    type: 'PATCH',
		    data: { folder_id : folder_id },
		    success: function(data) {
		    	var result = JSON.parse(data);
				$("#folder-path").text( result.path);
				swal("Nice!", "Document has been updated", "success");
		    }
		});
}
