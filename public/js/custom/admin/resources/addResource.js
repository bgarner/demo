$(document).ready(function(){

	$("#select_resource_id").closest('.form-group').hide();

	$("#select_resource_type").change(function(){
		
		var resource_type_id = $('#select_resource_type option:selected').val();
		$.ajax({
			    url: '/admin/resourcetype/'+ resource_type_id,
			    type: 'GET',
			    dataType: 'json',
			    success: function(result) {
			        
			    	if( result.length >0 ) {
			    		
			    		$("#select_resource_id option").remove();
			    		$('<option>').val("")
			    					.text("Select one")
			    					.appendTo('#select_resource_id');

						for (var i = 0; i < result.length ; i++) {
							$('<option>').val(result[i].id)
										 .text(result[i].resource_name)
										 .appendTo('#select_resource_id');
						}
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

});