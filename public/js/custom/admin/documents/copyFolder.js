	$( "#copy-folder").click(function(){

		var folderId = $(this).attr('data-folderid');
		var folderName = $(this).attr('data-foldername');
		var folderPath = $(this).attr('data-folderpath');
		if (localStorage.getItem('folderId') != folderId) {
			
			localStorage.removeItem('folderId');
			localStorage.removeItem('folderName');
			localStorage.removeItem('folderPath');
    		localStorage.setItem('folderId', folderId );
			localStorage.setItem('folderName', folderName );
			localStorage.setItem('folderPath', folderPath);
		}
		swal("Nice!", "'" + folderName +"' has been copied to clipboard", "success");        
	});

