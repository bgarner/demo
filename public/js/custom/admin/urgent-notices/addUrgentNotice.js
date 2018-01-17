$("#add-documents").click(function(){
	$("#attachment-selected").empty();
	$("#document-listing").modal('show');
});

$("#add-folders").click(function(){
	$("#attachment-selected").empty();
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

	if($('.urgentnotice-folders-table').hasClass('hidden')){
		$(".urgentnotice-folders-table").removeClass('hidden').addClass('visible');
	}
	
	$(".urgentnotice-folders-table").find("tbody").empty();
	$('input[name^="package_folders"]').each(function(){


		var attr = $(this).attr('data-folderRoot');
		
		// For some browsers, `attr` is undefined; for others,
		// `attr` is false.  Check for both.
		if (typeof attr !== typeof undefined && attr !== false) {
		    
		    $(".urgentnotice-folders-table").find("tbody").append('<tr class="urgentnotice-folders"> '+
													'<td data-folderid='+ $(this).val() +'>'+$(this).attr("data-foldername")+'</td>'+
													'<td></td>'+
													'<td> <a data-folder-id="'+ $(this).val()+'" id="folder'+ $(this).val()+'" class="remove-staged-folder btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												'</tr>');
		}
		
	});

});

$('#attach-selected-files').on('click', function(){
	

	if($('.urgentnotice-documents-table').hasClass('hidden')){
		$(".urgentnotice-documents-table").removeClass('hidden').addClass('visible');
	}
	$(".urgentnotice-documents-table").find("tbody").empty();
	
	$('input[name^="package_files"]').each(function(){
	
		if($(this).is(":checked")){
			
			$(".urgentnotice-documents-table").find("tbody").append('<tr class="urgentnotice-documents"> '+
													'<td data-fileid='+ $(this).val() +'>'+$(this).attr("data-filename")+'</td>'+
													'<td></td>'+
													'<td> <a data-file-id="'+ $(this).val()+'" id="file'+ $(this).val()+'" class="remove-staged-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												'</tr>');
		}
	});
	
});


$("body").on('click', ".remove-staged-file", function(){
	
	var document_id = $(this).attr('data-file-id');
	$(this).closest('.urgentnotice-documents').fadeOut(200);
	$(this).closest('.urgentnotice-documents').remove();

});

$("body").on('click', ".remove-staged-folder", function(){
	

	var folder_id = $(this).attr('data-folder-id');
	console.log('remove this folder' + folder_id);
	$(".urgentnotice-folders[data-folderid = '" + folder_id + "']").remove();
	$(this).closest('.urgentnotice-folders').fadeOut(200);

});

$(document).on('click','.urgentnotice-create',function(){
  	
  	var hasError = false;
 
	var title = $("#title").val();
	var description = CKEDITOR.instances['description'].getData();
	var start = $("#start").val();
	var end = $("#end").val();
	var banner_id = $("input[name='banner_id']").val();

	var all_stores = getAllStoreStatus();
	var target_stores = getTargetStores();
	var target_banners = getTargetBanners();
	var store_groups = getStoreGroups();


	var urgentnotice_documents = [];
	var urgentnotice_folders = [];
	$(".urgentnotice-documents").each(function(){
		urgentnotice_documents.push($(this).find('td:first').attr('data-fileid'));
	});
	$(".urgentnotice-folders").each(function(){
		urgentnotice_folders.push($(this).find('td:first').attr('data-folderid'));
	});

	$(".attachment").each(function(){
		attachments.push($(this).attr('data-attachmentid'));
	});

 
	console.log(description);
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
	if( target_stores == null || all_stores == null || store_groups == null ) {
		swal("Oops!", "Target stores not selected.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}

    if(hasError == false) {

		$.ajax({
		    url: '/admin/urgentnotice',
		    type: 'POST',
		    data: {
		  		title : title,
		  		description : description,
		  		start : start,
		  		end : end,
		  		banner_id : banner_id,
		  		urgentnotice_folders : urgentnotice_folders,
		  		urgentnotice_documents : urgentnotice_documents,
		  		all_stores : all_stores,
				target_stores : target_stores,
				target_banners : target_banners,
				store_groups : store_groups,
		  		attachment_type_id : 1 //adding dummy value to keep the database as was before; attachment_type would not hold any meaning though
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
		        	
		        	$('#createNewUrgentNoticeForm')[0].reset(); // empty the form
		        	CKEDITOR.instances['description'].setData('');
		        	$(".search-field").find('input').val('');
			        processStorePaste();
			        $(".urgentnotice-documents-table").find("tbody").empty();
			        $(".urgentnotice-documents-table").addClass('hidden');
			        $(".urgentnotice-folders-table").find("tbody").empty();
			        $(".urgentnotice-folders-table").addClass('hidden');
					swal("Nice!", "'" + title +"' has been created", "success");        
				}
		    }
		}).done(function(response){
			console.log(response);
		});    	
    }


    return false;
});
