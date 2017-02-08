$(document).ready(function(){
	$(".chosen").chosen({
		width:'75%'
	});
});


$(document).on('click','.group-edit',function(){
  	
  	var hasError = false;

  	var group_name = $("#group_name").val();
  	var group_id = $("#groupID").val();
    var components  = $("#components").val();
	
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
		        	swal({title:"Nice!", text: "'" + group_name +"' has been updated", type: 'success'});      	
		        // }

				
		    }
		});    	
    }


    return false;
});