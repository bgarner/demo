$("#add-documents").click(function(){
	$("#document-listing").modal('show');
});


$("#add-packages").click(function(){
	$("#package-listing").modal('show');
});


$("#add-flyers").click(function(){
	$("#flyer-listing").modal('show');
});

$('input[name="latest_updates_option"]').change( function(){
	if($('input[name=latest_updates_option]').is(':checked')){
		console.log($(this).next('input[name="update_frequency"]'));
		$('.update_frequency').prop( "disabled", true );
		$(this).next('.update_frequency').prop( "disabled", false );
	}
});

$('body').on('click', '#attach-selected-files', function(){
	
	if($('.feature-documents-table').hasClass('hidden')){
		$(".feature-documents-table").removeClass('hidden').addClass('visible');
	}
	$(".feature-documents-table").find("tbody").empty();
	$('input[name^="package_files"]').each(function(){
		
		if($(this).is(":checked")){
			
			$(".feature-documents-table").find("tbody").append('<tr class="feature-documents"> '+
													'<td data-fileid='+ $(this).val() +'>'+$(this).attr("data-filename")+'</td>'+
													'<td></td>'+
													'<td> <a data-file-id="'+ $(this).val()+'" id="file'+ $(this).val()+'" class="remove-staged-file btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												'</tr>');
		}
	});
});

$('body').on('click', '#attach-selected-packages', function(){

	if($('.feature-packages-table').hasClass('hidden')){
		$(".feature-packages-table").removeClass('hidden').addClass('visible');
	}
	
	$(".feature-packages-table").find("tbody").empty();
	$('input[name^="feature_packages"]').each(function(){
		if($(this).is(":checked")){
			
			$(".feature-packages-table").find("tbody").append('<tr class="feature-packages"> '+
													'<td data-packageid='+ $(this).attr('data-packageid') +'>'+ $(this).attr("data-packagename")+'</td>'+
													'<td></td>'+
													'<td> <a data-package-id="'+ $(this).val()+'" id="package'+ $(this).val()+'" class="remove-staged-package btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												'</tr>');
		}
		
	});
});

$('body').on('click', '#attach-selected-flyers', function(){

	if($('.feature-flyers-table').hasClass('hidden')){
		$(".feature-flyers-table").removeClass('hidden').addClass('visible');
	}
	
	$(".feature-flyers-table").find("tbody").empty();
	$('input[name^="feature_flyers"]').each(function(){
		if($(this).is(":checked")){
			
			$(".feature-flyers-table").find("tbody").append('<tr class="feature-flyers"> '+
													'<td data-flyerid='+ $(this).attr('data-flyerid') +'>'+ $(this).attr("data-flyername")+'</td>'+
													'<td></td>'+
													'<td> <a data-flyer-id="'+ $(this).val()+'" id="flyer'+ $(this).val()+'" class="remove-staged-flyer btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>'+
												'</tr>');
		}
		
	});
});

$("body").on('click', ".remove-staged-file", function(){
	
	var document_id = $(this).attr('data-file-id');
	$(this).closest('.feature-documents').fadeOut(200);
	$(this).closest('.feature-documents').remove();

});

$("body").on('click', ".remove-staged-package", function(){
	

	var package_id = $(this).attr('data-package-id');
	$(".feature-packages[data-packageid = '" + package_id + "']").remove();
	$(this).closest('.feature-packages').fadeOut(200);

});


$("body").on('click', ".remove-staged-flyer", function(){
	

	var flyer_id = $(this).attr('data-flyer-id');
	console.log('remove this flyer' + flyer_id);
	$(".feature-flyers[data-flyerid = '" + flyer_id + "']").remove();
	$(this).closest('.feature-flyers').fadeOut(200);

});



$(document).on('click','.feature-create',function(){
  	
 
  	var hasError = false;
 
	var featureTitle       = $("#feature_title").val();
	var featureTileLabel   = $("#tile_label").val();
	var featureStart       = $("#start").val();
	var featureEnd         = $("#end").val();
	var thumbnail          = $("#thumbnail")[0].files[0];
	var background         = $("#background")[0].files[0];
	var update_type        = $('input:radio[name =  "latest_updates_option"]:checked').val();
	var update_frequency   = $('input:radio[name ="latest_updates_option"]:checked').next(".update_frequency").val();
	var communication_type = $("#communicationTypes").val();
	var communications     = $("#communications").val();
	var event_types 	   = $("#eventTypes").val();
	var events             = $("#events").val();
	var all_stores         = getAllStoreStatus();
	var target_stores      = getTargetStores();
	var target_banners     = getTargetBanners();
	var store_groups       = getStoreGroups();
	var tasklists 		   = $("#tasklists").val();

	var feature_files = [];
	var feature_packages = [];
	var feature_flyers = [];

	$(".feature-documents").each(function(){
		feature_files.push($(this).find('td:first').attr('data-fileid'));
	});
	$(".feature-packages").each(function(){
		feature_packages.push($(this).find('td:first').attr('data-packageid'));
	});

	$(".feature-flyers").each(function(){
		feature_flyers.push($(this).find('td:first').attr('data-flyerid'));
	});
 	
    if(featureTitle == '') {
		swal("Oops!", "This feature needs a name.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}
	if(featureStart == '' || featureEnd == '') {
		swal("Oops!", "This feature needs start and end dates.", "error"); 
		hasError = true;
		return false;
	}

	if (typeof update_type === 'undefined' || update_frequency == '') {
		swal("Oops!", "Update type and update window size needs to be filled", "error"); 
		hasError = true;
		return false;
	};

	if(  target_stores == null || all_stores == null || store_groups == null  ) {
		swal("Oops!", "Target stores not selected.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}

	
     if(hasError == false) {
     	var data = new FormData();
     	data.append('name', featureTitle);
     	data.append('tileLabel', featureTileLabel);
     	data.append('start', featureStart);
     	data.append('end', featureEnd);
     	data.append('thumbnail', thumbnail);
     	data.append('background', background );
     	data.append('feature_files',  JSON.stringify(feature_files));
     	data.append('feature_packages',  JSON.stringify(feature_packages));
     	data.append('communication_type',  JSON.stringify(communication_type));
     	data.append('communications', JSON.stringify(communications));
     	data.append('event_types',  JSON.stringify(event_types));
     	data.append('events', JSON.stringify(events));
     	data.append('feature_flyers',  JSON.stringify(feature_flyers));
    	data.append('update_type', update_type);
    	data.append('update_frequency', update_frequency);
		data.append('all_stores', getAllStoreStatus());
  		data.append('target_stores', getTargetStores());
  		data.append('target_banners', getTargetBanners());
  		data.append('store_groups', getStoreGroups());
  		data.append('tasklists', JSON.stringify(tasklists));

		$.ajax({
		    url: '/admin/feature',
		    type: 'POST',
		    data: data, 
		    dataType: 'json',
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
		    success: function(result) {
		        console.log(result);
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
			        		$("#thumbnail").parent().append('<div class="req">' + errors.thumbnail[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("background")) {
			        	$.each(errors.background, function(index){
			        		$("#background").parent().append('<div class="req">' + errors.background[index]  + '</div>');	
			        	});
			        }

			        if(errors.hasOwnProperty("communication_type")) {
			        	$.each(errors.communication_type, function(index){
			        		$("#communicationTypes").parent().append('<div class="req">' + errors.communication_type[index]  + '</div>');	
			        	});
			        }

			        if(errors.hasOwnProperty("communications")) {
			        	$.each(errors.communications, function(index){
			        		$("#communications").parent().append('<div class="req">' + errors.communications[index]  + '</div>');	
			        	});
			        }

			        if(errors.hasOwnProperty("event_types")) {
			        	$.each(errors.event_types, function(index){
			        		$("#eventTypes").parent().append('<div class="req">' + errors.event_types[index]  + '</div>');	
			        	});
			        }

			        if(errors.hasOwnProperty("events")) {
			        	$.each(errors.events, function(index){
			        		$("#events").parent().append('<div class="req">' + errors.events[index]  + '</div>');	
			        	});
			        }

			        if(errors.hasOwnProperty("tasklists")) {
			        	$.each(errors.tasklists, function(index){
			        		$("#tasklists").parent().append('<div class="req">' + errors.tasklists[index]  + '</div>');	
			        	});
			        }

			        if(errors.hasOwnProperty("target_stores")) {
			        	console.log(1);
			        	$.each(errors.target_stores, function(index){
			        		$("#storeSelect").parent().append('<div class="req">' + errors.target_stores[index]  + '</div>');	
			        	});
			        }
		        }
		        else{
		        	$('#createNewFeatureForm')[0].reset(); // empty the form
					swal("Nice!", "'" + featureTitle +"' has been created", "success");
		        }

		        
		    }
		}).done(function(response){
			console.log(response);
		});    	
    }


    return false;
});