
$("body").on("click", ".folder", function(e){
	
	console.log(e);
	console.log(this.id);
	e.stopPropagation();
	var id = e.target.id;

	if($(this).find('.indicator').hasClass('fa-folder-open')) {
		if(id){
			getFolderDocuments(e.target.id);
		} else {
			getFolderDocuments(this.id);
		}	
	}	

});

var getFolderDocuments = function(id){
	
	var folder_id = id;
	$.ajax(
		{
			url : '/admin/document',
			data : {
						folder : folder_id,
						isWeekFolder : $(this).attr("data-isweek")
				   }
		}
	)
	.done(function(data){
		console.log(data);
		fillTable(data);
		setDeepLink(data);
		fillBreadCrumbs(data);
		$("#allChildFolderCount").val(data.folder.allChildFolderCount);
		$("#allDocumentsInFolderCount").val(data.folder.allDocumentsInFolderCount);
		$("#folderNameForDeleteModal").val(data.folder.name);
		console.log("**************");
		console.log($("#allChildFolderCount"));
		console.log($("#allDocumentsInFolderCount"));
		console.log("**************");
	});
}

var checkDeepLink = function(){
	if(window.location.hash){
		folderId = window.location.hash.substr(3);
		$("li#"+folderId).parents('.parent-folder').click();
		$("li#" + folderId).click();
		//getFolderDocuments(folderId);
	}
}
var setDeepLink = function(data){
	var id = window.location.hash;
	console.log(id);
	console.log(window.location.pathname);
	location.href = window.location.pathname + "#!/" + data.folder.global_folder_id;
}
	





