$(document).ready(function(){

	$(".chosen").chosen({
		width:'75%'
	});
	$("#select_resource_id").closest('.form-group').hide();

	$("#select_resource_id").closest('.form-group').hide();

	$("#select_resource_type").change(function(){
		
		var resource_type_id = $('#select_resource_type option:selected').val();
		$.ajax({
			    url: '/admin/resourcetype/'+ resource_type_id,
			    type: 'GET',
			    dataType: 'json',
			    success: function(result) {
			        
			    	if( result && Object.keys(result).length > 0 ) {
			    		
			    		$("#select_resource_id option").remove();
			    		$('<option>').val("")
			    					.text("Select one")
			    					.appendTo('#select_resource_id');

						$.each( result, function( key, value ) {
						    
						    $('<option>').val(key)
										 .text(value)
										 .appendTo('#select_resource_id');


						});
						$("#select_resource_id").trigger("chosen:updated");
						$("#select_resource_id").closest('.form-group').show();
			        }
			        else{
			        	$("#select_resource_id").closest('.form-group').hide();
			        }
			        
			    }
			}).done(function(data){
				console.log(data);
			});    
	});

	$(document).on('click','.resource-create',function(){
  	
	  	var hasError = false;

	    
	    var resource_type =  $("#select_resource_type").val();
	    var resource_id = $("#select_resource_id").val();	

	    console.log(resource_type);
	    console.log(resource_id);

	    if(resource_type == '') {
			swal("Oops!", "We need a resource type for this resource.", "error"); 
			hasError = true;
			$(window).scrollTop(0);
			return false;

		}

		if(resource_id == '') {
			swal("Oops!", "We need a resource selected.", "error"); 
			hasError = true;
			$(window).scrollTop(0);
			return false;

		}	

		if(hasError == false) {
			$.ajax({
			    url: '/admin/resource',
			    type: 'POST',
			    data: { 
			    	resource_type: resource_type, 
			    	resource_id : resource_id
			    },
			    success: function(result) {
			        console.log(result);
			        // $("#role").val(""); // empty the form
					swal("Nice!", "Resource has been created", "success");        
			    }
			});
		}
		
	    return false;

	});
});