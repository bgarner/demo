$(document).ready(function(){
	$(".chosen").chosen({
		width:'75%'
	});
});


$(document).on('click','.group-edit',function(){
  	
  	var hasError = false;

  	var group_name = $("#group_name").val();
  	var group_id = $("#groupID").val();
    var roles = [];
    roles  = $("#roles").val();
	console.log(roles);
    if(group_name == '') {
		swal("Oops!", "This event needs a title.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}	

    if(hasError == false) {

		$.ajax({
		    url: '/admin/group/' + group_id ,
		    type: 'PATCH',
		    dataType: 'json',
		    data: {
		    	id: group_id,
		  		group_name: group_name,
		    	roles : roles
		    },

		    success: function(data) {
		      console.log(data);
		        if(data != null && data.validation_result == 'false') {
		        	var errors = data.errors;
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
		        	swal({title:"Nice!", text: "'" + group_name +"' has been updated", type: 'success'});      	
		        }

				
		    }
		});    	
    }


    return false;
});