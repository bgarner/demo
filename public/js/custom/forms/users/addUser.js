$(document).ready(function(){

	$("#select-bu").closest('.form-group').hide();
	$("#select-role").change(function(){
		
		var role = $('#select-role option:selected').text();
		if(role != 'Product Request Form Admin'){
			$("#select-bu").closest('.form-group').show();
		}
		else{
			$("#select-bu").closest('.form-group').hide();
		}

	});

});




$(".user-create").click(function(){
	var firstname = $('input[name="firstname"]').val();
	var lastname = $('input[name="lastname"]').val();
	var username = $('input[name="username"]').val();
	var jobtitle = $('input[name="jobtitle"]').val();

	var group = $('#group').val();
	var role = $("#select-role").val();
	var rolename = $("#select-role option:selected").text();
	var banners = [1,2];
	
	var business_unit = $.makeArray($("#select-bu").val());
	if(group == 3 && rolename == 'Product Request Form Admin'){
		var business_unit = [];
		$('#select-bu option').each(function() {
		    if($(this).val()){
		    	business_unit.push($(this).val());
		    }
		});
	}

	// console.log(firstname, lastname, email, group, role, business_unit);
	var hasError = false;
	if(firstname == '') {
		swal("Oops!", "Need a first name.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}	

    if(lastname == '') {
		swal("Oops!", "We need a lastname.", "error"); 
		hasError = true;
		$(window).scrollTop(0);
		return false;
	}

	if(group == '') {
		swal("Oops!", "We need an group.", "error"); 
		hasError = true;
		return false;
	}

	if(banners == '') {
		swal("Oops!", "Select a banner.", "error"); 
		hasError = true;
		return false;
	}

    if(hasError == false) {
    	
		$.ajax({
		    url: '/form/user',
		    type: 'POST',
		    dataType: 'json',
		    data: {
		    	firstname : firstname,
		    	lastname : lastname,
		    	jobtitle : jobtitle,
		    	username : username,
		    	group : group,
		    	role : role,
		    	business_unit : business_unit,
		    	banners : banners
		    },
		    success: function(result) {
		        
		    	if(result.validation_result == 'false') {
		        	var errors = result.errors;
		        	if(errors.hasOwnProperty("firstname")) {
		        		$.each(errors.firstname, function(index){
		        			$('input[name="firstname"]').parent().append('<div class="req">' + errors.firstname[index]  + '</div>');	
		        		}); 	
		        	}
		        	
			        if(errors.hasOwnProperty("lastname")) {
			        	$.each(errors.lastname, function(index){
			        		$('input[name="lastname"]').parent().append('<div class="req">' + errors.lastname[index]  + '</div>');
			        	});
			        }
			        if(errors.hasOwnProperty("username")) {
			        	$.each(errors.username, function(index){
			        		$('input[name="username"]').parent().append('<div class="req">' + errors.username[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("group")) {
			        	$.each(errors.group, function(index){
			        		$('#select-group').parent().append('<div class="req">' + errors.group[index]  + '</div>');	
			        	});
			        }
			        if(errors.hasOwnProperty("banners")) {
			        	$.each(errors.banners, function(index){
			        		$('#select-banner').parent().append('<div class="req">' + errors.banners[index]  + '</div>');	
			        	});
			        }
			        
			        
		        }
		        else{
		        	console.log(result);
			        $('form')[0].reset(); // empty the form
					swal("Nice!", rolename+ " '" + firstname + " " + lastname +"' has been created", "success");        
		        }
		        
		    }
		}).done(function(data){
			console.log(data);
		});    	
    }


    return false;
});