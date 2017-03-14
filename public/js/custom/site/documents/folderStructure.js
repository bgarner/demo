
$("body").on("click", ".folder", function(e){
	
	e.stopPropagation();
	console.log( "Mouse event : " +e.hasOwnProperty('originalEvent'));
	console.log(this.id);
	
	if (e.hasOwnProperty('originalEvent')) {
		$("#archive-switch").removeClass('hidden').addClass('visible');
		
		var id = e.target.id;

		if(id){
			getFolderDocuments(e.target.id);
		} else {
			getFolderDocuments(this.id);
		}	
	}
	
});

var getFolderDocuments = function(id){
	
	var folder_id = id;
	var storeNumber = localStorage.getItem('userStoreNumber');
	var archives = $("#archives:checked").val();
	console.log(archives);
	var url =  '/'+ storeNumber +'/folder/' + folder_id ;
	if(archives == 'on') {
		url = '/'+ storeNumber + '/folder/' + folder_id +"?archives=true";
	}
	$.ajax(
		{
			url : url
		}
	)
	.done(function(data){
		console.log(data);
		fillTable(data);
		setDeepLink(data);
		fillBreadCrumbs(data);
	});
}

var checkDeepLink = function(){
	console.log('it all starts here;');
	if(window.location.hash){
		folderId = window.location.hash.substr(3);
		$("li#"+folderId).parents('.parent-folder').click();
		$("li#" + folderId).click();
		getFolderDocuments(folderId);

	}
}
var setDeepLink = function(data){
	var id = window.location.hash;
	console.log(id);
	console.log(window.location.pathname);
	location.href = window.location.pathname + "#!/" + data.folder.global_folder_id;
}
	





