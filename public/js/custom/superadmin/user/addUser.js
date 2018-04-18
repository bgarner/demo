$(document).ready(function(){

	$("#select-role").closest('.form-group').hide();
	$("#select-resource").closest('.form-group').hide();
	$("#select-bu").closest('.form-group').hide();

	$("#select-group").change(function(){
		
		var group = $('#select-group option:selected').val();
		console.log('/admin/group/' + group + '/roles');
		$.ajax({
			    url: '/admin/group/' + group + '/roles',
			    type: 'GET',
			    dataType: 'json',
			    success: function(result) {
			    	console.log(result);
			    	if( result.length >0 ) {
			    		$("#select-role option").remove();
			    		$('<option>').val("")
			    					 .text("Select one")
			    					 .appendTo('#select-role');
						for (var i = 0; i < result.length ; i++) {
							
							$('<option>').val(result[i].id)
										 .text(result[i].role_name)
										 .appendTo('#select-role');
						}
						$("#select-role").closest('.form-group').show();
			        }
			        else{
			        	$("#select-role").closest('.form-group').hide();
			        }
			        
			    }
			}).done(function(data){
				// console.log(data);
			});    
	});

	$("#select-role").change(function(){

		var group = $('#select-group').val();
		
		if( group == 2 ){
			getResources();
		}
		if(group == 3){
			showBU();
		}
		
		
	});

	var getResources = function(){
		var role = $('#select-role option:selected').val();

		// console.log("getting resources for role : " + role);
		$.ajax({
			    url: '/admin/role/' + role + '/resources',
			    type: 'GET',
			    dataType: 'json',
			    success: function(result) {
			        console.log(result);
			    	if( result && Object.keys(result).length > 0) {
			    		
			    		$("#select-resource option").remove();
			    		$('<option>').val("")
										 .text("Select one")
										 .appendTo('#select-resource');
			    		$.each( result, function( key, value ) {
			    			
						    $('<option>').val(key)
										 .text(value)
										 .appendTo('#select-resource');
						});

						$("#select-resource").closest('.form-group').show();
						$("#selected-resource").closest('.form-group').hide();
			        }
			        else{
			        	$("#select-resource").closest('.form-group').hide();
			        }
			        
			    }
			}).done(function(data){
				// console.log(data);
			});    
	}

	var showBU = function(){
		
		var role = $('#select-role option:selected').text();
		if(role != 'Product Request Form Admin'){
			$("#select-bu").closest('.form-group').show();
		}
		else{
			$("#select-bu").closest('.form-group').hide();
		}

	};


	$(".user-create").click(function(){
		var firstname = $('input[name="firstname"]').val();
		var lastname = $('input[name="lastname"]').val();
		var email = $('input[name="email"]').val();

		var password = $('input[name="password"]').val();
		var confirm_password = $('input[name="confirm_password"]').val();
		var group = $('#select-group option:selected').val();
		var role = $("#select-role option:selected").val();
		var roleValue = $("#select-role option:selected").text();
		var resource = $("#select-resource option:selected").val();
		
		var business_unit = $.makeArray($("#select-bu option:selected").val());

		
		if(group== 3 && roleValue == 'Product Request Form Admin'){
			var business_unit = [];
			$('#select-bu option').each(function() {
			    if($(this).val()){
			    	business_unit.push($(this).val());
			    }
			});
		}
		var groupname = $('#select-group option:selected').text();
		var banners = [];
		$('#select-banner option:selected').each(function(){ banners.push($(this).val()); });


		// console.log(firstname, lastname, email, group, role, resource, business_unit);
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
			    	role : role,
			    	resource : resource,
			    	business_unit : business_unit, 
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
