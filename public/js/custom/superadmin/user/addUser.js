$(document).ready(function(){
	$(".user-create").click(function(){
		var firstname = $('input[name="firstname"]').val();
		var lastname = $('input[name="lastname"]').val();
		var email = $('input[name="email"]').val();

		var password = $('input[name="password"]').val();
		var confirm_password = $('input[name="confirm_password"]').val();
		var group = $('#select-group option:selected').val();
		var groupname = $('#select-group option:selected').text();
		var banners = [];
		$('#select-banner option:selected').each(function(){ banners.push($(this).val()); });

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

	    if(email == '') {
			swal("Oops!", "We need an email.", "error"); 
			hasError = true;
			return false;
		}

		if (password == '' || confirm_password == '') {
			swal("Oops!", "Password and Confirm Password needs to be filled.", "error");
			hasError = true;
			return false;
		}

		if (password != confirm_password) {
			swal("Oops!", "Passwords do not match.", "error"); 
			hasError = true;
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
			    url: '/admin/user',
			    type: 'POST',
			    dataType: 'json',
			    data: {
			    	firstname : firstname,
			    	lastname : lastname,
			    	email : email,
			    	group : group,
			    	banners : banners,
			    	password : password,
			    	confirm_password : confirm_password
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
				        if(errors.hasOwnProperty("email")) {
				        	$.each(errors.email, function(index){
				        		$('input[name="email"]').parent().append('<div class="req">' + errors.email[index]  + '</div>');	
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
				        
				        if(errors.hasOwnProperty("password")) {
				        	$.each(errors.password, function(index){
				        		$('input[name="password"]').parent().append('<div class="req">' + errors.password[index]  + '</div>');	
				        	});
				        }
				        if(errors.hasOwnProperty("password_confirmation")) {
				        	$.each(errors.password_confirmation, function(index){
				        		$('input[name="confirm_password"]').parent().append('<div class="req">' + errors.password_confirmation[index]  + '</div>');	
				        	});
				        }
				        
			        }
			        else{
			        	console.log(result);
				        $('form')[0].reset(); // empty the form
						swal("Nice!", groupname+ " '" + firstname + " " + lastname +"' has been created", "success");        
			        }
			        
			    }
			}).done(function(data){
				console.log(data);
			});    	
	    }


	    return false;
	});
});
