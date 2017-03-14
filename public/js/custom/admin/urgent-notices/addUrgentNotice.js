$("#attachment-Document").click(function(){
	$("#attachment-selected").empty();
	$("#document-listing").modal('show');
});

$("#attachment-Folder").click(function(){
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

	var  attachment_type = $("input[name='attachment_type']").val();
	var  attachment_type = $("input[name='attachment_type']").val();
	$("#attachment-selected").empty();
	$("#attachment-selected").append('<p>Folders attached :</p>');
	$('input[name^="package_folders"]').each(function(){


		var attr = $(this).attr('data-folderRoot');
		
		// For some browsers, `attr` is undefined; for others,
		// `attr` is false.  Check for both.
		if (typeof attr !== typeof undefined && attr !== false) {
		    
		    $("#attachment-selected").append('<ul class="attachment" data-attachment-type="' + attachment_type +'" data-attachmentid='+ $(this).attr('data-folderid') +'>'+$(this).attr("data-foldername")+'</ul>')
		}
		
	});

	$("#attachment-selected").parent().removeClass('hidden');
});

$('#attach-selected-files').on('click', function(){
	var  attachment_type = $("input[name='attachment_type']").val();
	$("#attachment-selected").empty();
	$("#attachment-selected").append('<p>Files attached :</p>');
	$('input[name^="package_files"]').each(function(){
		console.log('hello');
		if($(this).is(":checked")){
			$("#attachment-selected").append('<ul class="attachment" data-attachment-type="' + attachment_type +'" data-attachmentid='+ $(this).val() +'>'+$(this).attr("data-filename")+'</ul>')
		}
	});
	$("#attachment-selected").parent().removeClass('hidden');
});


$("#allStores").change(function(){

	if ($("#allStores").is(":checked")) {

		$("#storeSelect option").each(function(index){			
			$(this).attr('selected', 'selected');
		});
		$("#storeSelect").chosen();
		
	}
	else if ($("#allStores").not(":checked")) {
		$("#storeSelect option").each(function(){
			$(this).removeAttr('selected');
		});
		$("#storeSelect").chosen();
		
	}
});

$(document).on('click','.urgentnotice-create',function(){
  	
  	var hasError = false;
 
	var title = $("#title").val();
	var description = CKEDITOR.instances['description'].getData();
	var start = $("#start").val();
	var end = $("#end").val();
	var attachment_type  = $("input[name='attachment_type']:checked").val();
	var banner_id = $("input[name='banner_id']").val();
	var target_stores  = $("#storeSelect").val();
	var allStores  = $("allStores:checked").val();
	var attachments = [];

	console.log(target_stores);

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
	if( target_stores == null && typeof allStores === 'undefined' ) {
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
		  		attachment_type : attachment_type,
		  		attachments : attachments,
		  		banner_id : banner_id,
		  		target_stores : target_stores,
		  		
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
					swal("Nice!", "'" + title +"' has been created", "success");        
				}
		    }
		}).done(function(response){
			console.log(response);
		});    	
    }


    return false;
});
