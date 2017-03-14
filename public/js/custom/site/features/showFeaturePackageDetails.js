$(".feature_package").on('click', function(){

	var packageId = $(this).attr('data-packageId');

	var packageOpen = $(this).find('.package-name').attr('data-package-open');
	
	console.log(packageOpen);
	if(packageOpen == 'false') {
	
		$(".feature_package").find('.package-name').attr('data-package-open', 'false');
		$(this).find('.package-name').attr('data-package-open', 'true');
		//close all other trees
		$('.tree').find('li').find('i').removeClass('fa-folder-open').addClass('fa-folder')
		

		$(".package-name").find('i').removeClass('fa-folder-open').addClass('fa-folder');
		$(this).find(".package-name").find('i').removeClass('fa-folder').addClass('fa-folder-open');

		//empty folder-documents from earlier
		$(".package-folder-document-listing").find(".folder-name").find("h3").empty();
		$(".package-folder-documents").find('table').empty();

		showPackageDocuments(packageId);
		showPackageFolders(packageId);	

	}
	else{
		console.log('here');
		$(this).find('.package-name').attr('data-package-open', 'false');
		$(this).find(".package-name").find('i').removeClass('fa-folder-open').addClass('fa-folder');
		$(".single-package-document-container[data-packageid = " + packageId+"]").removeClass('visible').addClass('hidden');
		$(".package-folder-listing[data-packageid = " + packageId+ "]").removeClass('visible').addClass('hidden');

	}	
	

});

var showPackageDocuments = function(packageId) {

	$(".package-document-listing .package-name").removeClass('hidden');
	$(".package-document-listing table").removeClass('hidden');

	$(".single-package-document-container").addClass('hidden');
	$(".single-package-document-container[data-packageid = " + packageId+"]").removeClass('hidden').addClass('visible');
}

var showPackageFolders = function(packageId) {
	$(".package-folder-listing").addClass('hidden');
	$(".package-folder-listing[data-packageid = " + packageId+ "]").removeClass('hidden').addClass('visible');
}

var getFolderDocuments = function(global_folder_id, packageId) {
	var storeNumber = localStorage.getItem('userStoreNumber');
	$.ajax(
		{
			url : '/'+ storeNumber +'/folder/' + global_folder_id
		}
	)
	.done(function(data){

		$(".package-document-listing .package-name").addClass('hidden');
		$(".package-document-listing table").addClass('hidden');

		console.log(data);
		
		var package_folder_name = $(".package-folder-document-listing[data-packageid= " + packageId + "]").find(".folder-name").find("h3");
		
		package_folder_name.empty().append("<i class='fa fa-folder-open-o'></i> " + data.folder.name)
		
		$(".package-folder-documents[data-packageid= " + packageId + "]").find('table').empty();
		
		if(data.files.length > 0 ) {
			$(".package-folder-documents[data-packageid= " + packageId + "]").find('table').append("<thead><tr>"+
																									"<th> Title </th>"+
																									"<th> Added </th>"+
																								"</tr></thead>" );
			$(".package-folder-documents[data-packageid= " + packageId + "]").find('table').append("<tbody>");
			_.each(data.files, function(i){
				$(".package-folder-documents[data-packageid= " + packageId + "]").find('.table').append("<tr>"+
																											"<td><div>" + i.link_with_icon + "</div></td>"+
																											"<td>" + i.prettyDateStart + "</td>"+
																										"</tr>" );
			});
			$(".package-folder-documents[data-packageid= " + packageId + "]").find('table').append("</tbody>");
		}

		
	});
}

$(".folder-item").on('click', function(e){
	e.stopPropagation(e);
	console.log($(e.target).find('i.indicator').first());
	// $(e.target).find('i.indicator').first().addClass('fa-folder-open');
	var global_folder_id = $(this).attr('id');
	var packageid = $(this).closest('.package-folder-listing').attr('data-packageid')
	getFolderDocuments(global_folder_id, packageid);
});

$("body").on("click", ".launchPDFViewer", function(e){
	var filepath = $(this).attr("data-file");
	$("#fileviewmodal").find('iframe').attr("src", filepath);
});