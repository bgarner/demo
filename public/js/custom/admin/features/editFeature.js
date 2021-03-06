$("#add-more-files").click(function(){
	$("#document-listing").modal('show');
});

$("#add-more-packages").click(function(){
	$("#package-listing").modal('show');
});

$("#add-more-flyers").click(function(){
	$("#flyer-listing").modal('show');
});



$('body').on('click', '#attach-selected-files', function(){
	
	$(".selected-files").remove();
	$('input[name^="package_files"]').each(function(){
		if($(this).is(":checked")){
			$(".feature-documents-table tbody").append('<tr class="selected-files"> '+
													'<td data-document-id='+ $(this).val() +'><i class="fa fa-file-o"></i> '+ $(this).attr("data-filename") +'</td>'+
													'<td></td>'+
													'<td class="align-right"> <a data-document-id="'+ $(this).val()+'" id="file'+ $(this).val()+'" class="remove-staged-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												 '</tr>');
		}

		if($(".feature-documents-table").hasClass('hidden') )	{
			$(".feature-documents-table").removeClass('hidden');
		}
	});
});

$('body').on('click', '#attach-selected-packages', function(){

	$(".selected-packages").remove();
	$('input[name^="feature_packages"]').each(function(){
		if($(this).is(":checked")){
			$(".feature-packages-table tbody").append( '<tr class="selected-packages"> '+
													'<td data-package-id='+ $(this).val() +'><i class="fa fa-folder-o"></i> '+ $(this).attr("data-packagename") +'</td>'+
													'<td></td>'+
													'<td class="align-right"> <a data-package-id="'+ $(this).val()+'" id="package'+ $(this).val()+'" class="remove-staged-package btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												 '</tr>');		
		}
		if($(".feature-packages-table").hasClass('hidden') )	{
			$(".feature-packages-table").removeClass('hidden');
		}
	});
});

$('body').on('click', '#attach-selected-flyers', function(){

	$(".selected-flyers").remove();
	$('input[name^="feature_flyers"]').each(function(){
		if($(this).is(":checked")){
			$(".feature-flyers-table tbody").append( '<tr class="selected-flyers"> '+
													'<td data-flyer-id='+ $(this).val() +'><i class="fa fa-folder-o"></i> '+ $(this).attr("data-flyername") +'</td>'+
													'<td></td>'+
													'<td class="align-right"> <a data-flyer-id="'+ $(this).val()+'" id="flyer'+ $(this).val()+'" class="remove-staged-flyer btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												 '</tr>');		
		}
		if($(".feature-flyers-table").hasClass('hidden') )	{
			// console.log($(".feature-flyers-table tbody .feature-flyers").length);
			$(".feature-flyers-table").removeClass('hidden');
		}
	});
});




$('body').on('click', ".remove-file", function(){
	// console.log('remove file');
	var document_id = $(this).attr('data-document-id');
	// console.log(document_id);
	$(this).closest('.feature-documents').fadeOut(200);
	$("#files-staged-to-remove").append('<div class="remove_document"  data-document-id='+ document_id +'>')
});

$('body').on('click', ".remove-package", function(){
	
	var package_id = $(this).attr('data-package-id');
	$(this).closest('.feature-packages').fadeOut(200);
	
	$("#packages-staged-to-remove").append('<div class="remove_package" data-package-id='+ package_id +'>');
});


$('body').on('click', ".remove-flyer", function(){

	var flyer_id = $(this).attr('data-flyer-id');
	$(this).closest('.feature-flyers').fadeOut(200);
	
	$("#flyers-staged-to-remove").append('<div class="remove_flyer" data-flyer-id='+ flyer_id +'>')
});



$("body").on('click', ".remove-staged-file", function(){
	
	
	var document_id = $(this).attr('data-document-id');
	// console.log('remove staged file' + document_id);
	$(this).closest('.selected-files').remove();
	// console.log($(this).closest('.selected-files'));
	$(this).closest('.selected-files').fadeOut(200);

});

$("body").on('click', ".remove-staged-package", function(){
	
	
	var package_id = $(this).attr('data-package-id');
	// console.log('remove stages package' + package_id);
	$(this).closest('.selected-packages').remove();
	$(this).closest('.selected-packages').fadeOut(200);

});

$("body").on('click', ".remove-staged-flyer", function(){
	
	
	var flyer_id = $(this).attr('data-flyer-id');
	// console.log('remove stages flyer' + flyer_id);
	$(this).closest('.selected-flyers').remove();
	$(this).closest('.selected-flyers').fadeOut(200);

});



$('input[id="thumbnail"]').on('change', function(){

	var featureID = $("#featureID").val();
	var thumbnail = $('input[id="thumbnail"]')[0].files[0];
	// console.log(featureID);
	var data = new FormData();
	data.append('thumbnail', thumbnail);
	data.append('featureID', featureID);
	// console.log(data);
	$.ajax({
		    url: '/admin/feature/thumbnail',
		    type: 'POST',
		    data: data, 
		    dataType: 'json',
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
		    success: function(result) {
		    	
		    	// console.log(result);
		    	if(result.validation_result == 'false') {
			    	var errors = result.errors;
			        if( errors ) {
			        	if(errors.hasOwnProperty("thumbnail")) {
			        		$.each(errors.thumbnail, function(index){
			        			$("#thumbnail").parent().append('<div class="req">' + errors.thumbnail[index]  + '</div>');	
			        		}); 	
			        	}
			        }
			    }
		        
	        	else{
	        		$(".thumbnail-preview img").attr('src', "/images/featured-covers/"+result);
	        	}
		        
		    }
		}).done(function(response){
			// console.log(response);
		});    

});

$('input[id="background"]').on('change', function(){

	var featureID = $("#featureID").val();
	var background = $('input[id="background"]')[0].files[0];
	var data = new FormData();
	data.append('background', background);
	data.append('featureID', featureID);

	$.ajax({
		    url: '/admin/feature/background',
		    type: 'POST',
		    data: data, 
		    dataType: 'json',
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
		    success: function(result) {
		        // console.log(result);
		        if(result.validation_result == 'false') {
			        var errors = result.errors;
			        if(  errors ) {
				        if(errors.hasOwnProperty("background")) {
			        		$.each(errors.background, function(index){
			        			$("#background").parent().append('<div class="req">' + errors.background[index]  + '</div>');	
			        		}); 	
			        	}
			        }
			    }
	        	else{
	        		$(".background-preview img").attr('src', "/images/featured-backgrounds/"+result);
	        	}
		        
		    }
		}).done(function(response){
			// console.log(response);
		});    

});

$('input[name="latest_updates_option"]').change( function(){
	if($('input[name=latest_updates_option]').is(':checked')){
		$('input[name="update_frequency"]').prop('disabled', true).val("");
		$(this).next('input[name="update_frequency"]').prop('disabled', false);
	}
});

$(document).on('click','.feature-update',function(){
  	
 
  	var hasError = false;
 	var featureID = $("#featureID").val();
 	
	var featureTitle = $("#feature_title").val();
	var featureTileLabel = $("#tile_label").val();
	var featureStart = $("#start").val();
	var featureEnd = $("#end").val();
	var thumbnail = $('input[id="thumbnail"]')[0].files[0];
	var background = $('input[id="background"]')[0].files[0];
	var remove_document = [];
	var remove_package   = [];
	var remove_flyer   = [];
	var feature_files = [];
	var feature_packages = [];
	var feature_flyers = [];
	var update_type = $('input:radio[name =  "latest_updates_option"]:checked').val();
	var update_frequency =  $('input:radio[name ="latest_updates_option"]:checked').next('input[name="update_frequency"]').val();
	var communication_type = $("#communicationType").val();
	var communications = $("#communications").val();
	var event_types = $("#eventTypes").val();
	var events = $("#events").val();
	var all_stores = getAllStoreStatus();
	var target_stores = getTargetStores();
	var target_banners = getTargetBanners();
	var store_groups = getStoreGroups();
	var tasklists = $("#tasklists").val();


	$(".remove_document").each(function(){
		remove_document.push($(this).attr('data-document-id'));
	});
	$(".remove_package").each(function(){
		remove_package.push($(this).attr('data-package-id'));
	});

	$(".remove_flyer").each(function(){
		remove_flyer.push($(this).attr('data-flyer-id'));
	});


	$(".selected-files").each(function(){
		feature_files.push($(this).find('td:first').attr('data-document-id'));
	});
	$(".selected-packages").each(function(){
		feature_packages.push($(this).find('td:first').attr('data-package-id'));
	});
	$(".selected-flyers").each(function(){
		feature_flyers.push($(this).find('td:first').attr('data-flyer-id'));
	});
 

    if(featureTitle == '') {
		swal("Oops!", "This feature needs a name.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if(featureStart == '' || featureEnd == '') {
		swal("Oops!", "Start and end dates cannot be empty", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if(update_frequency == '') {
		swal("Oops!", "Notification window size cannot be empty", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;	
	}
	if(target_stores == null || all_stores == null || store_groups == null ) {
		swal("Oops!", "Target stores not selected.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	

    if(hasError == false) {
     	var dataObj = {};
     	// console.log(typeof(dataObj));
     	$.extend(dataObj, {title: featureTitle});
     	$.extend(dataObj, {tileLabel: featureTileLabel});
     	$.extend(dataObj, {start: featureStart});
     	$.extend(dataObj, {end: featureEnd});
     	$.extend(dataObj, {feature_files:  feature_files});
     	$.extend(dataObj, {feature_packages:  feature_packages});
     	$.extend(dataObj, {feature_flyers:  feature_flyers});
     	$.extend(dataObj, {remove_document: remove_document});
     	$.extend(dataObj, {remove_package: remove_package});
     	$.extend(dataObj, {remove_flyer: remove_flyer});
     	$.extend(dataObj, {communication_type : communication_type});
     	$.extend(dataObj, {communications : communications});
     	$.extend(dataObj, {event_types : event_types});
     	$.extend(dataObj, {events : events});
     	$.extend(dataObj, {update_type : update_type});
     	$.extend(dataObj, {update_frequency : update_frequency});
     	$.extend(dataObj, {target_stores : target_stores});
     	$.extend(dataObj, {all_stores : allStores});
     	$.extend(dataObj, {target_banners : target_banners});
     	$.extend(dataObj, {store_groups : store_groups});
     	$.extend(dataObj, {tasklists : tasklists});
     	

     	var data = JSON.stringify(dataObj);
     	// console.log(dataObj);
     	// console.log(data);

		$.ajax({
		    url: '/admin/feature/' + featureID ,
		    type: 'PATCH',
		    data: data,
		    contentType: 'application/json',
		    dataType: 'json',
		    processData : false,
		    success: function(result) {
		    	if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("name")) {
		        		$.each(errors.name, function(index){
		        			$("#feature_title").parent().append('<div class="req">' + errors.name[index]  + '</div>');	
		        		}); 	
		        	}
			        if(errors.hasOwnProperty("documents")) {
			        	$.each(errors.documents, function(index){
			        		$("#files-selected").append('<div class="req">' + errors.documents[index]  + '</div>');
			        	});
			        }
			        if(errors.hasOwnProperty("packages")) {
			        	$.each(errors.packages, function(index){
			        		$("#packages-selected").append('<div class="req">' + errors.packages[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("flyers")) {
			        	$.each(errors.flyers, function(index){
			        		$("#flyers-selected").append('<div class="req">' + errors.flyers[index]  + '</div>');	
			        	});
			        }

			        if(errors.hasOwnProperty("update_type_id")) {
			        	$.each(errors.update_type_id, function(index){
			        		$(".latest-updates-container").append('<div class="req">' + errors.update_type_id[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("update_frequency")) {
			        	$.each(errors.update_frequency, function(index){
			        		$(".latest-updates-container").append('<div class="req">' + errors.update_frequency[index]  + '</div>');	
			        	});
			        }
			        
			        if(errors.hasOwnProperty("start")) {
			        	$.each(errors.start, function(index){
			        		$(".input-daterange").parent().append('<div class="req">' + errors.start[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("end")) {
			        	$.each(errors.end, function(index){
			        		$(".input-daterange").append('<div class="req">' + errors.end[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("thumbnail")) {
			        	$.each(errors.thumbnail, function(index){
			        		$("#thumbnail").append('<div class="req">' + errors.thumbnail[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("background")) {
			        	$.each(errors.background, function(index){
			        		$("#background").append('<div class="req">' + errors.background[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("communication_type")) {
			        	$.each(errors.communication_type, function(index){
			        		$("#communicationType").parent().append('<div class="req">' + errors.communication_type[index]  + '</div>');	
			        	});
			        }

			        if(errors.hasOwnProperty("communications")) {
			        	$.each(errors.communications, function(index){
			        		$("#communications").parent().append('<div class="req">' + errors.communications[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("events")) {
			        	$.each(errors.events, function(index){
			        		$("#events").parent().append('<div class="req">' + errors.events[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("event_types")) {
			        	$.each(errors.event_types, function(index){
			        		$("#event_types").parent().append('<div class="req">' + errors.event_types[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("tasklists")) {
			        	$.each(errors.tasklists, function(index){
			        		$("#tasklists").parent().append('<div class="req">' + errors.tasklists[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("target_stores")) {
			        	$.each(errors.target_stores, function(index){
			        		$("#storeSelect").parent().append('<div class="req">' + errors.target_stores[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("allStores")) {
			        	$.each(errors.allStores, function(index){
			        		$("#storeSelect").parent().append('<div class="req">' + errors.allStores[index]  + '</div>');	
			        	});
			        }
			    }
	        
		        else{
		        	swal("Nice!", "'" + featureTitle +"' has been updated", "success");
			    }
		    }
		}).done(function(response){
			// console.log(response);
			// console.log("********");
			$(".existing-files-container").load("/admin/featuredocuments/"+featureID);
			$("#files-staged-to-remove").empty();
			$("#files-selected").empty();
			$("#document-listing").find(".document-checkbox").prop('checked', false);

			$(".existing-folders-container").load("/admin/featurepackages/"+featureID);
			$("#packages-staged-to-remove").empty();
			$("#packages-selected").empty();
			$("#package-listing").find(".package-checkbox").prop('checked', false);

			$(".existing-flyers-container").load("/admin/featureflyers/"+featureID);
			$("#flyers-staged-to-remove").empty();
			$("#flyers-selected").empty();
			$("#flyer-listing").find(".flyer-checkbox").prop('checked', false);
		});    	
    }


    return false;
});