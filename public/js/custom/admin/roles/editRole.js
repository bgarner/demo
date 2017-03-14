$(document).ready(function(){
	$(".chosen").chosen({
		width:'75%'
	});
});


$(document).on('click','.role-edit',function(){
  	
  	var hasError = false;

  	var role_name = $("#role_name").val();
  	var role_id = $("#roleID").val();
    var groups  = $("#groups").val();
    var components = $("#components").val();
	
    if(role_name == '') {
		swal("Oops!", "This event needs a title.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}	

    if(hasError == false) {

		$.ajax({
		    url: '/admin/role/' + role_id ,
		    type: 'PATCH',
		    dataType: 'json',
		    data: {
		    	id: role_id,
		  		role_name: role_name,
		    	groups : groups,
		    	components : components
		    },

		    success: function(data) {
		      console.log(data);
		        // if(data != null && data.validation_result == 'false') {
		        // 	var errors = data.errors;
		        // 	if(errors.hasOwnProperty("section_name")) {
		        // 		$.each(errors.title, function(index){
		        // 			$("#section_name").parent().append('<div class="req">' + errors.title[index]  + '</div>');	
		        // 		}); 	
		        // 	}
		        // }
		        // else{
		        	swal({title:"Nice!", text: "'" + role_name +"' has been updated", type: 'success'});      	
		        // }

				
		    }
		});    	
    }


    return false;
});