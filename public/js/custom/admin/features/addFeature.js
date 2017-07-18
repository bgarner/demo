$("#add-documents").click(function(){
	$("#document-listing").modal('show');
});


$("#add-packages").click(function(){
	$("#package-listing").modal('show');
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

$("body").on('click', ".remove-staged-file", function(){
	
	var document_id = $(this).attr('data-file-id');
	$(this).closest('.feature-documents').fadeOut(200);
	$(this).closest('.feature-documents').remove();

});

$("body").on('click', ".remove-staged-package", function(){
	

	var package_id = $(this).attr('data-package-id');
	console.log('remove this package' + package_id);
	$(".feature-packages[data-packageid = '" + package_id + "']").remove();
	$(this).closest('.feature-packages').fadeOut(200);

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

	console.log(thumbnail);
	console.log(background);
	console.log(update_type);
	console.log(update_frequency);
	console.log(communication_type);
	console.log(communications);

	var feature_files = [];
	var feature_packages = [];
	$(".feature-documents").each(function(){
		feature_files.push($(this).find('td:first').attr('data-fileid'));
	});
	$(".feature-packages").each(function(){
		feature_packages.push($(this).find('td:first').attr('data-packageid'));
	});
 	
 	console.log(feature_files);
 	console.log(feature_packages);

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
    	data.append('update_type', update_type);
    	data.append('update_frequency', update_frequency);

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