$(document).ready(function(){
	$(".chosen").chosen({
				  width:'75%'
			});
});

$(document).on('click','.component-create',function(){
  	
  	var hasError = false;

    var component_name = $("#component_name").val();
    var roles =  $("#roles").val();
    var bannerId = localStorage.getItem('admin-banner-id');

    console.log(component_name, 
		    	roles, 
		    	bannerId );
    if(component_name == '') {
		swal("Oops!", "This we need a name for this component.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;

	}		

	if(hasError == false) {
		$.ajax({
		    url: '/admin/component',
		    type: 'POST',
		    dataType: 'json',
		    data: { 
		    	component_name: component_name, 
		    	roles: roles, 
		    	banner_id: bannerId 
		    },
		    success: function(result) {
		    	console.log(result)
		    	if(result.validation_result == 'false') {
		    		var errors = result.errors;
			        	if(errors.hasOwnProperty("component_name")) {
			        		$.each(errors.component_name, function(index){
			        			$('#component_name').parent().append('<div class="req">' + errors.component_name[index]  + '</div>');	
			        		}); 	
			        	}
			        	if(errors.hasOwnProperty("roles")) {
			        		$.each(errors.roles, function(index){
			        			$('#roles').parent().append('<div class="req">' + errors.roles[index]  + '</div>');	
			        		}); 	
			        	}
		    	}
		    	else{
			        $("#section").val(""); // empty the form
					swal("Nice!", "'" + component_name +"' has been created", "success");        
				}
		    }
		});
	}
	
    return false;
}); 