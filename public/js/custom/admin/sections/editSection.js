$(document).ready(function(){
	$(".chosen").chosen({
		width:'75%'
	});
});


$(document).on('click','.section-edit',function(){
  	
  	var hasError = false;

  	var section_name = $("#section_name").val();
  	var section_id = $("#sectionID").val();
    var groups  = $("#groups").val();
	
    if(section_name == '') {
		swal("Oops!", "This event needs a title.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}	

    if(hasError == false) {

		$.ajax({
		    url: '/admin/section/' + section_id ,
		    type: 'PATCH',
		    dataType: 'json',
		    data: {
		    	id: section_id,
		  		section_name: section_name,
		    	groups : groups
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
		        	swal({title:"Nice!", text: "'" + section_name +"' has been updated", type: 'success'});      	
		        // }

				
		    }
		});    	
    }


    return false;
});