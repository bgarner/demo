$(document).on("click", ".deleteFile", function() {
	console.log("file delete requested");
	var fileId = $(this).attr('data-fileid');
	var selector = "#file"+fileId;
	console.log("selector: " + selector);
		// e.preventDefault();
	swal({
	    title: "Are you sure?",
	    //text: "You will not be able to recover this imaginary file!",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "Yes, delete it!",
	    closeOnConfirm: false
	}, function () {
		$.ajax({
		    url: '/admin/document/'+ fileId,
		    type: 'DELETE',
		    success: function(result) {
		        $(selector).closest('tr').fadeOut(1000);
		        swal("Deleted!", "This file has been deleted.", "success");
		    }
		});
        
    });
	return false; 
});

$(document).on('click', "#delete-multiple", function(){

	var selectedDocuments = $(".select_document:checked");
	swal({
	    title: "Are you sure?",
	    text: selectedDocuments.length + " documents will be deleted.",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "Yes, delete it!",
	    closeOnConfirm: false
	}, function () {
		
		var selectedDocuments = $(".select_document:checked");
		$.each(selectedDocuments, function(index, doc){
			var document_id = $(this).attr('data-fileid');	
			var selector = "#file"+document_id;	
			$.ajax({
			    url: '/admin/document/'+ document_id,
			    type: 'DELETE',
			    success: function(result) {
			        $(selector).closest('tr').fadeOut(1000);
			    }
			});
		}).promise().done( 
						function(selectedDocuments){ 
							swal("Deleted!", selectedDocuments.length+ " files  deleted.", "success"); 
						}
					);
        
    });
	return false; 

});