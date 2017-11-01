$("#allStores").change(function(){

	if ($("#allStores").is(":checked")) {

		$("#storeSelect option").each(function(){
			$(this).removeAttr('selected');
		});
		$("#storeSelect").chosen('chosen:updated');

		$("#storeSelect option").each(function(index){			
			$(this).prop('selected', 'selected');
		});
		$("#storeSelect").chosen('chosen:updated');
		
	}
	else if ($("#allStores").not(":checked")) {
		$("#storeSelect option").each(function(){
			$(this).removeAttr('selected');
		});
		$("#storeSelect").chosen('chosen:updated');
		
	}
});


$("body").on('click', "#add-more-documents", function(){
	$("#document-listing").modal('show');
});

$("body").on('click', "#add-more-folders", function(){
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


$('#attach-selected-folders').on('click', function(){

	console.log('ygukyfhs');
	$(".selected-folders").remove();
	$('input[name^="package_folders"]').each(function(){
		var attr = $(this).attr('data-folderRoot');
		
		if (typeof attr !== typeof undefined && attr !== false) {
			console.log('4567');
			$(".urgentnotice-folders-table tbody").append('<tr class="selected-folders"> '+
													'<td data-folder-id='+ $(this).val() +'><i class="fa fa-file-o"></i> '+ $(this).attr("data-foldername") +'</td>'+
													'<td></td>'+
													'<td> <a data-folder-id="'+ $(this).val()+'" id="folder'+ $(this).val()+'" class="remove-staged-folder btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												 '</tr>');
		}

		if($(".urgentnotice-folders-table").hasClass('hidden') )	{
			console.log($(".urgentnotice-folders-table tbody .urgentnotice-folders").length);
			$(".urgentnotice-folders-table").removeClass('hidden');
		}
	})
});

$('#attach-selected-files').on('click', function(){
	$(".selected-files").remove();
	$('input[name^="package_files"]').each(function(){
		if($(this).is(":checked")){
			$(".urgentnotice-documents-table tbody").append('<tr class="selected-files"> '+
													'<td data-document-id='+ $(this).val() +'><i class="fa fa-file-o"></i> '+ $(this).attr("data-filename") +'</td>'+
													'<td></td>'+
													'<td> <a data-document-id="'+ $(this).val()+'" id="file'+ $(this).val()+'" class="remove-staged-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												 '</tr>');
		}

		if($(".urgentnotice-documents-table").hasClass('hidden') )	{
			console.log($(".urgentnotice-documents-table tbody .urgentnotice-documents").length);
			$(".urgentnotice-documents-table").removeClass('hidden');
		}
	});
});


$("body").on('click',".remove-file", function(){
	var document_id = $(this).attr('data-document-id');
	console.log(document_id);
	$(this).closest('.urgentnotice-documents').fadeOut(200);
	$("#files-staged-to-remove").append('<div class="remove_document" data-documentid='+ document_id +'>')
});

$("body").on('click',".remove-folder", function(){
	console.log($(this));
	var folder_id = $(this).attr('data-folder-id');
	$(this).closest('.urgentnotice-folders').fadeOut(200);
	$("#folders-staged-to-remove").append('<div class="remove_folder" data-folderid='+ folder_id +'>')
});

$("body").on('click', ".remove-staged-file", function(){
	
	var document_id = $(this).attr('data-document-id');
	$(this).closest('.selected-files').remove();
	$(this).closest('.selected-files').fadeOut(200);

});

$("body").on('click', ".remove-staged-folder", function(){
		
	var folder_id = $(this).attr('data-folder-id');
	console.log('remove staged file' + folder_id);
	$(this).closest('.selected-folders').remove();
	console.log($(this).closest('.selected-folders'));
	$(this).closest('.selected-folders').fadeOut(200);

});


$(document).ready(function(){
	var attachment_type_selected = $("#attachment_type_selected").val();
	$("input[name='attachment_type'][value="+ attachment_type_selected+"]").prop('checked', true);
	if($("#allStores").prop('checked')) {
		$("#storeSelect option").each(function(index){			
			$(this).attr('selected', 'selected');
		});
		$("#storeSelect").chosen();
	}

});

$(document).on('click','.urgentnotice-update',function(){
  	
  	var hasError = false;
 	var urgent_notice_id = $("#urgent_noticeID").val();
	var title = $("#title").val();
	var description = CKEDITOR.instances['description'].getData();
	var start = $("#start").val();
	var end = $("#end").val();
	var banner_id = $("input[name='banner_id']").val();
	var all_stores = getAllStoreStatus();
	var target_stores = getTargetStores();
	var target_banners = getTargetBanners();
	var store_groups = getStoreGroups();	
	var remove_document = [];
	var remove_folder = [];
	var urgentnotice_files = [];
	var urgentnotice_folders = [];
	
	$(".remove_document").each(function(){
		remove_document.push($(this).attr('data-documentid'));
	});
	$(".remove_folder").each(function(){
		remove_folder.push($(this).attr('data-folderid'));
	});
	console.log(remove_folder);
	$(".selected-files").each(function(){
		urgentnotice_files.push($(this).find('td:first').attr('data-document-id'));
	});
	$(".selected-folders").each(function(){
		urgentnotice_folders.push($(this).find('td:first').attr('data-folder-id'));
	});
 
    if(title == '' ) {
		swal("Oops!", "Title is required.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if(start == '' || end == '' ) {
		swal("Oops!", "Start and End Dates required.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if( target_stores == null && typeof allStores === 'undefined' ) {
		swal("Oops!", "Target stores not selected.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}

    if(hasError == false) {

		$.ajax({
		    url: '/admin/urgentnotice/' + urgent_notice_id,
		    type: 'PATCH',
		    data: {
		  		title : title,
		  		description : description,
		  		start : start,
		  		end : end,
		  		banner_id : banner_id,
		  		all_stores : all_stores,
				target_stores : target_stores,
				target_banners : target_banners,
				store_groups : store_groups,
		  		remove_document : remove_document,
				remove_folder : remove_folder,
				urgentnotice_files : urgentnotice_files,
				urgentnotice_folders : urgentnotice_folders
	

		  		
		    },
		    dataType : 'json', 
		    success: function(data) {
		        console.log(data);
		        if(data != null && data.validation_result == 'false') {
		        	var errors = data.errors;
		        	if(errors.hasOwnProperty("title")) {
		        		$.each(errors.title, function(index){
		        			$("#title").parent().append('<div class="req">' + errors.title[index]  + '</div>');	
		        		}); 	
		        	}
		        	if(errors.hasOwnProperty("attachment_type_id")) {
		        		$.each(errors.attachment_type_id, function(index){
		        			$("#attachment-Folder").parent().parent().append('<div class="req">' + errors.attachment_type_id[index]  + '</div>');	
		        		}); 	
		        	}
		        	if(errors.hasOwnProperty("folder")) {
		        		$.each(errors.folder, function(index){
		        			$("#attachment-Folder").parent().parent().append('<div class="req">' + errors.folder[index]  + '</div>');	
		        		}); 	
		        	}
		        	
			        if(errors.hasOwnProperty("start")) {
			        	$.each(errors.title, function(index){
			        		$("#start").parent().parent().append('<div class="req">' + errors.start[0]  + '</div>');
			        	});
			        }
			        if(errors.hasOwnProperty("end")) {
			        	$.each(errors.title, function(index){
			        		$("#end").parent().parent().append('<div class="req">' + errors.end[0]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("target_stores")) {		        	
		        		$("#storeSelect").parent().append('<div class="req">' + errors.target_stores[0]  + '</div>');
		        	}
		        	if(errors.hasOwnProperty("allStores")) {		        	
		        		$("#storeSelect").parent().append('<div class="req">' + errors.allStores[0]  + '</div>');
		        	}
		        	if(errors.hasOwnProperty("store")) {		        	
		        		$("#storeSelect").parent().append('<div class="req">' + errors.store[0]  + '</div>');
		        	}

		        }
		        else{
		        	console.log(data);
		        	// $('#createNewUrgentNoticeForm')[0].reset(); // empty the form
		        	$(".existing-files-container").load("/admin/urgentnotice-documents/"+urgent_notice_id);
					$("#files-staged-to-remove").empty();
					$("#files-selected").empty();
					$("#document-listing").find(".document-checkbox").prop('checked', false);

					$(".existing-folders-container").load("/admin/urgentnotice-folders/"+urgent_notice_id);
					$("#folders-staged-to-remove").empty();
					$("#folders-selected").empty();
					$("#folder-listing").find(".folder-checkbox").prop('checked', false);
					swal("Nice!", "'" + title +"' has been updated", "success");        
				}
		    }
		}).done(function(response){
			console.log(response);
		});    	
    }


    return false;
});
