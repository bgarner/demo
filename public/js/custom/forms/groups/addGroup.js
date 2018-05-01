$(document).ready(function(){
	// $("#users").closest('.form-group').hide();
    // check the "product request form option"
});


$("#form").change(function(){
	
	var form = $('#form option:selected').val();
	console.log('/form/' + form + '/users');
	$.ajax({
		    url: '/form/' + form + '/users',
		    type: 'GET',
		    dataType: 'json',
		    success: function(result) {
		    	console.log(result);
		    	if( result.length >0 ) {
		    		$("#users option").remove();
		    		$('<option>').val("")
		    					 .text("Select one")
		    					 .appendTo('#users');
					for (var i = 0; i < result.length ; i++) {
						console.log(result[i].id);
						console.log(result[i].firstname);
						$('<option>').val(result[i].id)
									 .text(result[i].firstname + " " + 
									 		result[i].lastname + " ( " +
									 		result[i].fglposition + " )"
									 	)
									 .appendTo('#users');
					}
					console.log($("#users option"));
					$("#users").closest('.form-group').show();
					$("#users").trigger("chosen:updated");
					
		        }
		        else{
		        	$("#users").closest('.form-group').hide();
		        }
		        
		    }
		}).done(function(data){
			// console.log(data);
		});    
});

$(".group-create").click(function(){
    var hasError = false;

    var form_id = $("#form").val();
    var users = $("#users").val();
    var group_name = $("#group_name").val();
    var businessUnit = $("#businessUnit").val();


    if(group_name == '') {
        swal("Oops!", "We need a group name.", "error");
        hasError = true;
        $(window).scrollTop(0);
    }

    if(form_id == '') {
        swal("Oops!", "Form missing.", "error");
        hasError = true;
        $(window).scrollTop(0);
    }

    if(businessUnit == null) {
        swal("Oops!", "We need a Business Unit.", "error");
        hasError = true;
        $(window).scrollTop(0);
    }
    if(users == null) {
        swal("Oops!", "We need some users for the group.", "error");
        hasError = true;
        $(window).scrollTop(0);
    }

    if(hasError == false) {
        $.ajax({
            url: '/form/group',
            type: 'POST',
            data: { 
            	'form_id': form_id,
            	'group_name' : group_name, 
            	'users': users,
                'businessUnit' : businessUnit
            },
            dataType : 'json',
            success: function(data) {
                console.log(data);
                if(data.validation_result == 'false'){
                    var errors = data.errors;
                    console.log(errors);
                    $( ".error" ).remove();
                    if(errors.hasOwnProperty("group_name")) {
                        $.each(errors.group_name, function(index){
                            $("#group_name").parent().append('<div class="req error">' + errors.group_name[index]  + '</div>'); 
                        });     
                    }
                    if(errors.hasOwnProperty("form_id")) {
                        $.each(errors.form_id, function(index){
                            $("#form").parent().append('<div class="req error">' + errors.form_id[index]  + '</div>'); 
                        });     
                    }
                    if(errors.hasOwnProperty("users")) {
                        $.each(errors.users, function(index){
                            $("#users").parent().append('<div class="req error">' + errors.users[index]  + '</div>'); 
                        });     
                    }
                    if(errors.hasOwnProperty("businessUnit")) {
                        $.each(errors.businessUnit, function(index){
                            $("#businessUnit").parent().append('<div class="req error">' + errors.businessUnit[index]  + '</div>'); 
                        });     
                    }

                }
                else{

                
                    swal("Nice!", "Group has been created", "success");
                }

            }
        });
    }

    return false;
});
