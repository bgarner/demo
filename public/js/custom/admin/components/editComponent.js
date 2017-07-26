$(document).ready(function(){
	$(".chosen").chosen({
		width:'75%'
	});
});


$(document).on('click','.component-edit',function(){
  	
  	var hasError = false;

  	var component_name = $("#component_name").val();
  	var component_id = $("#componentID").val();
    var roles  = $("#roles").val();
	
    if(component_name == '') {
		swal("Oops!", "This event needs a title.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}	

    if(hasError == false) {

		$.ajax({
		    url: '/admin/component/' + component_id ,
		    type: 'PATCH',
		    dataType: 'json',
		    data: {
		    	id: component_id,
		  		component_name: component_name,
		    	roles : roles
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
		        	swal({title:"Nice!", text: "'" + component_name +"' has been updated", type: 'success'});      	
		        }

				
		    }
		});    	
    }


    return false;
});