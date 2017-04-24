$(document).ready(function(){
	$(".chosen").chosen({
				  width:'75%'
			});

	$("#components").closest('.form-group').hide();
	$("#resource_type").closest('.form-group').hide();
});

$("#group").change(function(){

		var groupId = $("#group").val();
		if(groupId == 1)
		{
			$("#components").closest('.form-group').show();
			$("#resource_type").closest('.form-group').hide();
		}
		if(groupId == 2)
		{
			$("#resource_type").closest('.form-group').show();
			$("#components").closest('.form-group').hide();
		}

});

$(document).on('click','.role-create',function(){
  	
  	var hasError = false;

    var role_name = $("#role_name").val();
    var group =  $("#group").val();
    var components =  $("#components").val();
    var resource_type =  $("#resource_type").val();
    var bannerId = localStorage.getItem('admin-banner-id');

    if(role_name == '') {
		swal("Oops!", "We need a name for this role.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;

	}		

	if(hasError == false) {
		$.ajax({
		    url: '/admin/role',
		    type: 'POST',
		    data: { 
		    	role_name: role_name, 
		    	group: group, 
		    	components : components, 
		    	resource_type : resource_type,
		    	banner_id: bannerId 
		    },
		    success: function(result) {
		    	console.log(result)
		    	if(result.validation_result == 'false') {
		    		var errors = result.errors;
			        	if(errors.hasOwnProperty("group")) {
			        		$.each(errors.group, function(index){
			        			$('#group').parent().append('<div class="req">' + errors.group[index]  + '</div>');	
			        		}); 	
			        	}
			        	if(errors.hasOwnProperty("components")) {
			        		$.each(errors.components, function(index){
			        			$('#components').parent().append('<div class="req">' + errors.components[index]  + '</div>');	
			        		}); 	
			        	}
			        	if(errors.hasOwnProperty("resource_type")) {
			        		$.each(errors.resource_type, function(index){
			        			$('#resource_type').parent().append('<div class="req">' + errors.resource_type[index]  + '</div>');	
			        		}); 	
			        	}
		    	}
		    	else{
		    		console.log(result);
		        	$("#role").val(""); // empty the form
					swal("Nice!", "'" + role_name +"' has been created", "success");        	
		    	}
		        
		    }
		});
	}
	
    return false;
}); 