$(document).on("click", "#copy-document", function() {
		console.log('are we here?');
		var documentId = $(this).attr('data-fileid');
		var documentName = $(this).attr('data-documentName');
		var documentTitle = $(this).attr('data-documenttitle');
		var documentFolderPath = $("#copy-folder").attr('data-folderpath');
		if (localStorage.getItem('documentId') != documentId) {
			
			localStorage.removeItem('documentId');
			localStorage.removeItem('documentName');
			localStorage.removeItem('documentFolderPath');
    		localStorage.setItem('documentId', documentId );
			localStorage.setItem('documentName', documentName );
			localStorage.setItem('documentTitle', documentTitle);
			localStorage.setItem('documentFolderPath', documentFolderPath);
		}

		swal("Nice!", "'" + documentTitle +"' has been copied to clipboard", "success");        
	});

