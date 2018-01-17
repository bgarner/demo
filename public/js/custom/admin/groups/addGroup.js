$(document).ready(function(){
	$(".chosen").chosen({
				  width:'75%'
			});
});

$(document).on('click','.group-create',function(){
  	
  	var hasError = false;

    var group_name = $("#group_name").val();
    var roles = [];
    roles =  $("#roles").val();
    var bannerId = localStorage.getItem('admin-banner-id');

    if(group_name == '') {
		swal("Oops!", "This we need a name for this group.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;

	}		

	if(hasError == false) {
		$.ajax({
		    url: '/admin/group',
		    type: 'POST',
		    data: { group_name: group_name, roles: roles, banner_id: bannerId },
		    success: function(result) {
		    	// var result = JSON.parse(result);

		    	if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("group_name")) {
		        		$.each(errors.group_name, function(index){
		        			$("#group_name").parent().append('<div class="req">' + errors.group_name[index]  + '</div>');	
		        		}); 	
		        	}
		        	if(errors.hasOwnProperty("roles")) {
		        		$.each(errors.roles, function(index){
		        			$("#roles").parent().append('<div class="req">' + errors.roles[index]  + '</div>');	
		        		}); 	
		        	}
		        }
		        else{
		        	$("#group").val(""); // empty the form
					swal("Nice!", "'" + group_name +"' has been created", "success");        	
		        }
		        
		    }
		});
	}
	
    return false;
}); 