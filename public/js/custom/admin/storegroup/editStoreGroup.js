$(document).ready(function(){
	$(".chosen").chosen({
		width:'75%'
	});
});


$(document).on('click','.group-edit',function(){
  	
  	var hasError = false;

  	var group_name = $("#group_name").val();
  	var group_id = $("#groupID").val();
    var stores = [];
    stores  = $("#storeSelect").val();
	console.log(stores);
    if(group_name == '') {
		swal("Oops!", "This group needs a title.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}	

    if(hasError == false) {

		$.ajax({
		    url: '/admin/storegroup/' + group_id ,
		    type: 'PATCH',
		    dataType: 'json',
		    data: {
		    	id: group_id,
		  		group_name: group_name,
		    	stores : stores
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
		        	if(errors.hasOwnProperty("stores")) {
		        		$.each(errors.stores, function(index){
		        			$("#storeSelect").parent().append('<div class="req">' + errors.stores[index]  + '</div>');	
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