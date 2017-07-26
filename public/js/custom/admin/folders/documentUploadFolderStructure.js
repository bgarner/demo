
// $("body").on("load") function(e){
$( document ).ready(function() {
	
	var folderId = window.location.hash.substr(3);

	// console.log(folderId);

	getFolderDocuments(folderId);


	// if(id){
	// 	getFolderDocuments(e.target.id);
	// } else {
	// 	getFolderDocuments(this.id);
	// }

});

var getFolderDocuments = function(id){
	// console.log("this is the id for the ajax call: " + id);
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
		// console.log(data);
		fillTable(data);
		// console.log("this is what we are sending to setDeepLink " + data.folder.global_folder_id);
		setDeepLink(data.folder.global_folder_id);
		fillBreadCrumbs(data);
		$("#folder-name-for-upload").html("to  <i>"+data.folder.name+"</i>");
		$("#folder_id").val(data.folder.global_folder_id);

	});
}

var checkDeepLink = function(){
	if(window.location.hash){
		folderId = window.location.hash.substr(3);
		$("li#" + folderId).click();
		//getFolderDocuments(folderId);
	}
}
var setDeepLink = function(folderId){
	var id = window.location.hash;
	// console.log(id);
	// console.log("folderId: " +folderId);
	// console.log(window.location.pathname);
	location.href = window.location.pathname + "#!/" + folderId;
}
	





