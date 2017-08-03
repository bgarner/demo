$(document).on('click','.component-edit',function(){
  	
  	var hasError = false;

  	
  	var component_id = $(this).data('component-id');
  	var currentState = $(this).data('state');

  	console.log(component_id);

    if(hasError == false) {

		$.ajax({
		    url: '/admin/storecomponent/' + component_id ,
		    type: 'PATCH',
		    dataType: 'json',
		    data: {
		    	state: currentState,
		    },

		    success: function(result) {
		      
		      	console.log(result);
		        if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("component_name")) {
		        		$.each(errors.component_name, function(index){
		        			$("#component_name").parent().append('<div class="req">' + errors.component_name[index]  + '</div>');	
		        		}); 	
		        	}
		        	if(errors.hasOwnProperty("component_id")) {
		        		$.each(errors.component_id, function(index){
		        			$("#component_name").parent().append('<div class="req">' + errors.component_id[index]  + '</div>');	
		        		}); 	
		        	}
		        	if(errors.hasOwnProperty("roles")) {
		        		$.each(errors.roles, function(index){
		        			$("#roles").parent().append('<div class="req">' + errors.roles[index]  + '</div>');	
		        		}); 	
		        	}
		        }
		        else{
		        	$("#store_component_"+ component_id).attr('data-state', JSON.parse(result.config).state);
		        	$("#store_component_"+ component_id).toggleClass('btn-primary').toggleClass('btn-default');
		        	$("#store_component_"+ component_id).find('i').toggleClass('fa-eye').toggleClass('fa-eye-slash')      	
		        }

				
		    }
		});    	
    }


    return false;
});