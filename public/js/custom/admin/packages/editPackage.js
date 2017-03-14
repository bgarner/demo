$(document).ready(function(){

	
	$('#attach-selected-files').on('click', function(){
		// $("#files-selected").append('<p>Files attached :</p>');
		$("#files-selected").empty();
		$('input[name^="package_files"]').each(function(){
			if($(this).is(":checked")){
				$("#files-selected").append('<div class="col-md-10 col-md-offset-2"><div class="row">'+
											'<div class="package-files col-md-8 " data-fileid='+ $(this).val() +'> '+
												'<div class="package-filename selected-files" data-fileid='+ $(this).val() +'><i class="fa fa-file-o"></i> '+  $(this).attr("data-filename")+
											'</div></div>'+
											'<a data-document-id="'+ $(this).val()+'" id="file'+ $(this).val()+'" class="remove-staged-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div></div>');
			}
		});
	});

	$('#attach-selected-folders').on('click', function(){

		$("#folders-selected").empty();
		
		$('input[name^="package_folders"]').each(function(){
			
			var attr = $(this).attr('data-folderRoot');

			// For some browsers, `attr` is undefined; for others,
			// `attr` is false.  Check for both.
			if (typeof attr !== typeof undefined && attr !== false) {
			    
			    $("#folders-selected").append(	'<div class="col-md-10 col-md-offset-2"><div class="row">'+			    								'<div class="package-folders col-md-8 " data-folderid='+ $(this).attr('data-folderid') +'>'+
			    									'<div class="package-foldername selected-folders" data-folderid='+ $(this).attr('data-folderid') +'><i class="fa fa-folder-o"></i> '+ $(this).attr("data-foldername")+
			    									'</div></div>'+
			    								'<a data-folder-id="'+ $(this).val()+'" id="file'+ $(this).val()+'" class="remove-staged-folder btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></div></div>');
			}
			
		});
	});

	

});



$("#add-more-files").on('click', function(){
	$("#document-listing").modal('show');
})
$("#add-more-folders").on('click', function(){
	$("#folder-listing").modal('show');
})

$("body").on('click', ".remove-file", function(){
	var document_id = $(this).attr('data-document-id');
	$(this).parent().fadeOut(200);
	$("#files-staged-to-remove").append('<div class="remove_document"  data-documentid='+ document_id +'>')
});

$("body").on('click', ".remove-staged-file", function(){
	
	var document_id = $(this).attr('data-document-id');
	$(".package-files[data-fileid = '" + document_id + "']").remove();
	
	$(this).parent().fadeOut(200);

});
$("body").on('click', ".remove-staged-folder", function(){
	
	
	var folder_id = $(this).attr('data-folder-id');
	$(this).parent().fadeOut(200);
	$(".package-folders[data-folderid = '" + folder_id + "']").remove();

});

$("body").on('click', ".remove-folder", function(){
	var folder_id = $(this).attr('data-folder-id');
	console.log(folder_id);
	$(this).parent().fadeOut(200);
	
	$("#folders-staged-to-remove").append('<div class="remove_folder" data-folderid='+ folder_id +'>')
});

$("#add-documents").click(function(){
	$("#document-listing").modal('show');
});


$("#add-folders").click(function(){
	$("#folder-listing").modal('show');
});


$(".folder-checkbox").on('click', function(){
	if($(this).is(":checked")){
		$(this).attr('data-folderRoot', 'true')
		 $(this).siblings('ul')
            .find("input[type='checkbox']")
            .prop('checked', this.checked)
            .attr("disabled", true);

	}else{
		$(this).removeAttr('data-folderRoot')
	    $(this).siblings('ul')
            .find("input[type='checkbox']")
            .prop('checked', false)
            .attr("disabled", false);
	}	
});

$(".package-update").on('click', function(){
	console.log("update received");
	var hasError = false;
 
	var packageName = $("#name").val();
	var packageTitle = $("#label").val();
	var packageID = $("#packageID").val();
	var package_files = [];
	var package_folders = [];
	var remove_document = [];
	var remove_folder   = [];

	$(".selected-files").each(function(){
		package_files.push($(this).attr('data-fileid'));
	});
	$(".selected-folders").each(function(){
		package_folders.push($(this).attr('data-folderid'));
	});
	$(".remove_document").each(function(){
		remove_document.push($(this).attr('data-documentid'));
	});
	$(".remove_folder").each(function(){
		remove_folder.push($(this).attr('data-folderid'));
	});
 	

    if(packageName == '') {
		swal("Oops!", "This package needs a name.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if(packageTitle == '') {
		swal("Oops!", "This package needs a label.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}

	console.log(packageTitle);
	console.log(packageName);

    if(hasError == false) {

		$.ajax({
		    url: '/admin/package/' + packageID ,
		    type: 'PATCH',
		    dataType: 'json',
		    data: {
		  		title: packageTitle,
		  		name: packageName,
		  		package_files: package_files,
		  		package_folders: package_folders,
		  		remove_document : remove_document,
		  		remove_folder : remove_folder

		    },
		    success: function(result) {
		        console.log(result);
		    	if(result != null && result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("package_screen_name")) {
		        		$.each(errors.package_screen_name, function(index){
		        			$("#name").parent().append('<div class="req">' + errors.package_screen_name[index]  + '</div>');	
		        		}); 	
		        	}
		        	if(errors.hasOwnProperty("package_name")) {
			        	$.each(errors.package_name, function(index){
			        		$("#label").parent().append('<div class="req">' + errors.package_name[index]  + '</div>');
			        	});
			        }
			        if(errors.hasOwnProperty("documents")) {
			        	$.each(errors.documents, function(index){
			        		$("#files-selected").append('<div class="req">' + errors.documents[index]  + '</div>');
			        	});
			        }
			        if(errors.hasOwnProperty("remove_documents")) {
			        	$.each(errors.documents, function(index){
			        		$("#files-selected").append('<div class="req">' + errors.documents[index]  + '</div>');
			        	});
			        }
			        if(errors.hasOwnProperty("folders")) {
			        	$.each(errors.folders, function(index){
			        		$("#folders-selected").append('<div class="req">' + errors.folders[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("remove_folders")) {
			        	$.each(errors.folders, function(index){
			        		$("#folders-selected").append('<div class="req">' + errors.folders[index]  + '</div>');	
			        	});
			        }
		        }
		        else{
		        	swal("Nice!", "'" + packageName +"' has been updated", "success");        
		        }

		    }
		}).done(function(response){
			console.log(response);
			$(".existing-files-container").load("/admin/packagedocuments/"+packageID);
			$(".existing-folders-container").load("/admin/packagefolders/"+packageID);

			$("#files-staged-to-remove").empty();
 			$("#files-selected").empty();
 			$("#document-listing").find(".document-checkbox").prop('checked', false);

 			$("#folders-staged-to-remove").empty();
 			$("#folders-selected").empty();
 			$("#folder-listing").find(".folder-checkbox").prop('checked', false);
 			$("#folder-listing").find(".folder-checkbox").removeAttr('data-folderroot');
		});    	
    }


    return false;
});

$(".package-filename").on('click', function (){
	var fileId = $(this).attr('data-fileid');
	//open modal here to show the document
});

$(".package-foldername").on('click', function(){
	var folderId = $(this).attr('data-folderid');
	console.log("folderId : " + folderId);
	console.log("/admin/document/manager#!/" + folderId);
	window.location = "/admin/document/manager#!/"+ folderId;
});